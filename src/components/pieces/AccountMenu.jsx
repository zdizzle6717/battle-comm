'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import classNames from 'classnames';
import {UserActions} from '../../library/authentication';

const mapStateToProps = (state) => {
	return {
		'user': state.user
	}

	this.getPlayerIcon = this.getPlayerIcon.bind(this);
}

class AccountMenu extends React.Component {
	constructor() {
		super();

		this.state = {
			'showMenu': false
		}

		this.toggleMenu = this.toggleMenu.bind(this);
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
				<img src={this.getPlayerIcon()} onClick={this.toggleMenu} />
				{
					this.state.showMenu &&
					<div className="menu">
						<h3>
							{this.props.user.username}
						</h3>
						<ul onClick={this.toggleMenu}>
							<li><Link key="userDashboard" to="/players/dashboard"><span className="fa fa-dashboard"></span>My Dashboard</Link></li>
							<li><Link key="userDashboard" to={`/players/profile/${this.props.user.username}`}><span className="fa fa-user"></span>My Public Profile</Link></li>
							<li><Link to="/players"><span className="fa fa-search"></span>Search</Link></li>
							<li><Link to="/players/dashboard/notifications"><span className="fa fa-envelope"></span>Notifications</Link></li>
							<li><Link to="/admin"><span className="fa fa-indent"></span>Admin</Link></li>
							<li onClick={this.props.logout}><a>Logout</a></li>
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
	'logout': React.PropTypes.func
}

export default connect(mapStateToProps, null)(AccountMenu);
