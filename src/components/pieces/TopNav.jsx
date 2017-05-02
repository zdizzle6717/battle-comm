'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {Link, withRouter} from 'react-router-dom';
import {connect} from 'react-redux';
import classNames from 'classnames';
import Animation from 'react-addons-css-transition-group';
import {AlertActions} from '../../library/alerts';
import {UserActions} from '../../library/authentication';
import AccountMenu from './AccountMenu';
import CartSummary from './CartSummary';

const mapStateToProps = (state) => {
	return {
		'user': state.user,
		'isAuthenticated': state.isAuthenticated
	}
}

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'logout': UserActions.logout,
		'setRedirect': UserActions.setRedirect
    }, dispatch);
};

class TopNav extends React.Component {
	constructor() {
		super();

		this.state = {
			'showMobileMenu': false
		}

		this.closeMenu = this.closeMenu.bind(this);
		this.toggleMenu = this.toggleMenu.bind(this);
		this.logout = this.logout.bind(this);
		this.showAlert = this.showAlert.bind(this);
	}

	closeMenu() {
		this.setState({
			'showMobileMenu': false
		});
	}

	toggleMenu() {
		this.setState({
			'showMobileMenu': !this.state.showMobileMenu
		});
	}

	logout() {
		this.props.logout();
		// TODO: Set redirect doesn't seem to be working.
		this.props.setRedirect(false);
		this.showAlert('logoutSuccess');
		this.props.history.push('/');
	}

	showAlert(selector) {
		const alerts = {
			'logoutSuccess': () => {
				this.props.addAlert({
					'title': 'Logout Success',
					'message': 'You have been successfully logged out.',
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

	render() {
		let backdropClasses = classNames({
			'menu-backdrop': true,
			'show': this.state.showMobileMenu
		});
		let toggleClasses = classNames({
			'on': this.state.showMobileMenu
		});

	    return (
			<div className="nav">
				<div className="menu-toggle" onClick={this.toggleMenu}>
					<i id="toggle" className={toggleClasses}><span></span></i>
				</div>
				<div className="login-menu-mobile">
					{
						this.props.isAuthenticated &&
						<CartSummary></CartSummary>
					}
					{
						this.props.isAuthenticated ?
						<AccountMenu logout={this.logout}></AccountMenu> :
						<div className="login-link">
							<Link key="login" to="/login" className="menu-link">Login</Link>
						</div>
					}
				</div>
				<Animation transitionName="slide-top" className="animation-wrapper" transitionEnter={true} transitionEnterTimeout={250} transitionLeave={true} transitionLeaveTimeout={250}>
					<div className="menu-group" key="menu" onClick={this.closeMenu}>
						<ul className="main-menu">
							<li className="home">
								<Link key="home" to="/" className="menu-link">Home</Link>
							</li>
							<li className="news">
								<Link key="news" to="/news" className="menu-link">News</Link>
							</li>
							<li className="ranking">
								<Link key="ranking" to="/ranking/search/all" className="menu-link">Ranking</Link>
							</li>
							<li className="players">
								<Link key="players" to="/players" className="menu-link">Players</Link>
							</li>
							<li className="store">
								<Link key="store" to="/store" className="menu-link">Store</Link>
							</li>
						</ul>
						<ul className="login-menu">
							{
								this.props.isAuthenticated &&
								<CartSummary></CartSummary>
							}
							{
								this.props.isAuthenticated ?
								<AccountMenu logout={this.logout}></AccountMenu> :
								<li className="login-link">
									<Link key="login" to="/login" className="menu-link">Login</Link>
								</li>
							}
						</ul>
					</div>
					{
						this.state.showMobileMenu &&
						<div className="mobile-menu-group" key="mobile-menu" onClick={this.closeMenu}>
							<ul className="main-menu">
								<li className="">
									<Link key="home" to="/" className="menu-link">Home</Link>
								</li>
								<li className="">
									<Link key="news" to="/news" className="menu-link">News</Link>
								</li>
								<li className="">
									<Link key="ranking" to="/ranking/search/all" className="menu-link">Ranking</Link>
								</li>
								<li className="">
									<Link key="players" to="/players" className="menu-link">Players</Link>
								</li>
								<li className="">
									<Link key="store" to="/store" className="menu-link">Store</Link>
								</li>
							</ul>
							<ul className="login-menu">
								{
									this.props.isAuthenticated &&
									<CartSummary></CartSummary>
								}
								{
									this.props.isAuthenticated ?
									<AccountMenu logout={this.logout}></AccountMenu> :
									<li className="login-link">
										<Link key="login" to="/login" className="menu-link">Login</Link>
									</li>
								}
							</ul>
						</div>
					}
				</Animation>
				<div className={backdropClasses} onClick={this.closeMenu}></div>
			</div>
	    );
	}
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(TopNav));
