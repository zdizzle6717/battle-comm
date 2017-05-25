'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router-dom';
import classNames from 'classnames';
import PropTypes from 'prop-types';
import {UserActions, AccessControl as createAccessControl} from '../../library/authentication';
import roleConfig from '../../../roleConfig';
const AccessControl = createAccessControl(roleConfig);
import UserNotificationActions from '../../actions/UserNotificationActions';

const mapStateToProps = (state) => {
	return {
		'user': state.user,
		'notifications': state.userNotifications
	}

	this.getPlayerIcon = this.getPlayerIcon.bind(this);
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'getNotifications': UserNotificationActions.search
	}, dispatch);
}

class AccountMenu extends React.Component {
	constructor() {
		super();

		this.state = {
			'showMenu': false
		}

		this.getNotifications = this.getNotifications.bind(this);
		this.toggleMenu = this.toggleMenu.bind(this);
	}

	componentDidMount() {
		this.getNotifications();
	}

	getNotifications() {
		this.props.getNotifications({
			'UserId': this.props.user.id,
			'pageNumber': 1,
			'pageSize': 10,
			'orderBy': 'updatedAt'
		});
	}

	getPlayerIcon() {
		let userPhoto = this.props.user.UserPhoto;
		return userPhoto ? `/uploads/players/${this.props.user.id}/playerIcon/300-${this.props.user.UserPhoto.name}` : '/uploads/players/defaults/300-profile-icon-default.png';
	}

	toggleMenu() {
		this.setState({
			'showMenu': !this.state.showMenu
		})
	}

	render() {
		return (
			<div className="account-menu pointer">
				{
					this.props.notifications.length > 0 &&
					<span className="notification-count">{this.props.notifications.length}</span>
				}
				<img src={this.getPlayerIcon()} onClick={this.toggleMenu} />
				{
					this.state.showMenu &&
					<div className="menu">
						<h3>
							{this.props.user.username}
						</h3>
						<ul onClick={this.toggleMenu}>
							<li>
								<Link to="/players/dashboard"><span className="fa fa-dashboard"></span>My Dashboard</Link>
							</li>
							<li>
								<Link to={`/players/profile/${this.props.user.username}`}><span className="fa fa-user"></span>My Public Profile</Link>
							</li>
							<li>
								<Link to="/players"><span className="fa fa-search"></span>Search</Link>
							</li>
							<li>
								<Link to="/players/dashboard/notifications" className="notification-link"><span className="fa fa-envelope"></span>Notifications {
									this.props.notifications.length > 0 &&
									<span className="count">{this.props.notifications.length}</span>
								}</Link>
							</li>
							<AccessControl element="li" access={['tourneyAdmin', 'eventAdmin', 'venueAdmin', 'newsContributor']}>
								<Link to="/admin"><span className="fa fa-indent"></span>Admin</Link>
							</AccessControl>
							<li onClick={this.props.logout}>
								<a>Logout</a>
							</li>
						</ul>
					</div>
				}
				{
					this.state.showMenu &&
					<div className="click-away-backdrop" onClick={this.toggleMenu}></div>
				}
			</div>
		)
	}
}

AccountMenu.propTypes = {
	'logout': PropTypes.func
}

export default connect(mapStateToProps, mapDispatchToProps)(AccountMenu);
