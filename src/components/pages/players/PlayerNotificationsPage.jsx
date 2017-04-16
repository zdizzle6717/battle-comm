'use strict';

import React from 'react';
import {Link} from 'react-router';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {AlertActions} from '../../../library/alerts';
import ViewWrapper from '../../ViewWrapper';
import UserFriendService from '../../../services/UserFriendService';
import UserNotificationActions from '../../../actions/UserNotificationActions';

const mapStateToProps = (state) => {
	return {
		'currentUser': state.user,
		'notifications': state.userNotifications
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'getNotifications': UserNotificationActions.search,
		'sendNotification': UserNotificationActions.create,
		'removeNotification': UserNotificationActions.remove
	}, dispatch);
}

// TODO: configure pagination better

class PlayerNotificationsPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {}
		}

		this.handleNotificationsPageChange = this.handleNotificationsPageChange.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Notifications";
		this.handleNotificationsPageChange(1);
    }

	acceptAllyRequest(notificationId, fromId, fromUsername) {
		UserFriendService.create({
			'UserId': this.props.currentUser.id,
			'InviteeId': fromId
		}).then((newFriend) => {
			this.props.removeNotification(notificationId).then(() => {
				this.handleNotificationsPageChange(1).then(() => {
					this.props.sendNotification({
						'UserId': fromId,
						'type': 'allyRequestAccepted',
						'fromId': this.props.currentUser.id,
						'fromUsername': this.props.currentUser.username,
						'fromName': this.props.currentUser.firstName + ' ' + this.props.currentUser.lastName
					}).then(() => {
						this.showAlert('newAlly', fromUsername);
					});
				});
			})
		});
	}

	handleNotificationsPageChange(pageNumber = 1) {
		return this.props.getNotifications({
			'UserId': this.props.currentUser.id,
			'pageNumber': pageNumber,
			'pageSize': 10,
			'orderBy': 'updatedAt'
		}).then((pagination) => {
			this.setState({
				'pagination': pagination
			});
		});
	}

	removeNotification(notificationId, fromUsername, alertName) {
		this.props.removeNotification(notificationId).then(() => {
			this.handleNotificationsPageChange(1).then(() => {
				switch(alertName) {
					case 'allyRequestIgnored':
						this.showAlert('allyRequestIgnored', fromUsername);
						break;
					default:
						return;
				}
			});
		});
	}

	showAlert(selector, data) {
		const alerts = {
			'allyRequestIgnored': (data) => {
				this.props.addAlert({
					'title': 'Ally Request Ignore',
					'message': `You have chosen to ignore an ally request from ${data}`,
					'type': 'info',
					'delay': 3000
				});
			},
			'newAlly': (fromUsername) => {
				this.props.addAlert({
					'title': 'Ally Request Approved',
					'message': `You have formed a new alliance with ${fromUsername}`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector](data);
	}

    render() {
        return (
            <ViewWrapper>
			<div className="player-dashboard">
				<div className="row">
					<div className="small-12 columns">
						<h1>Player Notifications</h1>
					</div>
                </div>
                <div className="row">
					<div className="small-12 medium-6 columns">
						<h2>Notifications</h2>
						<div className="notification">
							{
								this.props.notifications.filter((notification) => notification.type === 'allyRequestReceived').length > 0 ?
								this.props.notifications.filter((notification) => notification.type === 'allyRequestReceived').map((notification, i) =>
									<div key={i} className="container ice push-bottom">
										<div className="">
											New ally request from <strong>{notification.fromUsername}</strong>
										</div>
										<div className="text-right">
											<br/>
											<button className="button push-right" onClick={this.acceptAllyRequest.bind(this, notification.id, notification.fromId, notification.fromUsername)}>Accept?</button>
											<button className="button" onClick={this.removeNotification.bind(this, notification.id, notification.fromUsername, 'allyRequestIgnored')}>Reject?</button>
										</div>
									</div>
								) :
								<div className=""><h3>There are currently no pending notifications</h3></div>
							}
						</div>
					</div>
					<div className="small-12 medium-6 columns">
						<h2>Messages</h2>
							<div className="notification">
								{
									this.props.notifications.filter((notification, i) => notification.type === 'allyRequestAccepted').length > 0 ?
									this.props.notifications.filter((notification) => notification.type === 'allyRequestAccepted').map((notification, i) =>
										<div key={i} className="container ice push-bottom">
											<span className="fa fa-times" onClick={this.removeNotification.bind(this, notification.id, notification.fromUsername)}></span>
											<div className="">
												<strong>{notification.fromUsername}</strong> accepted your ally request
											</div>
										</div>
									) :
									<div className=""><h3>There are currently no pending messages</h3></div>
								}
							</div>
					</div>
                </div>
			</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PlayerNotificationsPage);
