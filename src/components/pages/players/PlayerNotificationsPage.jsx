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
		'currentUser': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'getNotifications': userNotifications.search,
		'removeNotification': userNotifications.remove
	}, dispatch);
}

// TODO: configure pagination better

class PlayerNotificationsPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': pagination
		}

		this.getNotifications = this.getNotifications.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Notifications";
		this.getNotifications();
    }

	acceptAllyRequest(notificationId, fromId) {
		this.props.removeNotification(notificationId);
		UserFriendService.create({
			'UserId': this.props.currentUser.id,
			'InviteeId': fromId
		}).then((newFriend) => {
			this.showAlert('newAlly', newFriend)
		});
	}

	ignoreAllyRequest(notificationId, fromUsername) {
		this.props.removeNotification(notificationId).then(() => {
			this.showAlert('allyRequestIgnored', fromUsername)
		});
	}

	getNotifications() {
		this.props.getNotifications({
			'UserId': this.props.currentUser.id,
			'pageNumber': 1,
			'pageSize': 10,
			'orderBy': 'updatedAt'
		}).then((pagination) => {
			this.setState({
				'pagination': pagination
			})
		});
	}

	showAlert(selector, data) {
		const alerts = {
			'allyRequestIgnored': (data) => {
				this.props.addAlert({
					'title': 'Ally Request Ignore',
					'message': `You have chosen to ignore an ally request from ${data}`,
					'type': 'success',
					'delay': 3000
				});
			},
			'newAlly': (data) => {
				this.props.addAlert({
					'title': 'Ally Request Approved',
					'message': `You have formed a new alliance with ${data.username}`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
        return (
            <ViewWrapper>
                <div className="row">
					<div className="small-12 columns">
						<h1>Player Notifications</h1>
					</div>
                </div>
                <div className="row">
					<div className="small-12 medium-6 columns">
						<h2>Notifications</h2>
						{
							this.props.notifications.filter((notificaiton) => notification.type === 'allyRequestReceived' || notification.type === 'allyRequestAccepted').map((notification, i) =>
								<div key={i} className="notification">
									<div className="panel">
										<div className="panel-title primary">
											New ally request from {notification.fromUsername}
										</div>
										<div className="panel-content">
											More request details
											<br/>
											<button className="button" onClick={this.acceptAllyRequest.bind(this, notification.id, notification.fromId)}>Accept?</button>
											<button className="button" onClick={this.ignoreAllyRequest.bind(this, notificaiton.id, notification.fromUsername)}>Reject?</button>
										</div>
									</div>
								</div>
							)
						}
					</div>
					<div className="small-12 medium-6 columns">
						<h2>Messages</h2>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps);
