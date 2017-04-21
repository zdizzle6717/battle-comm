'use strict';

import React from 'react';
import {Link, browserHistory} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import Animation from 'react-addons-css-transition-group';
import {syncHistoryWithStore} from 'react-router-redux';
import {Alerts} from '../library/alerts'
import {Loader} from '../library/loader';
import {AlertActions} from '../library/alerts';
import {LoaderActions} from '../library/loader';
import {UserActions, checkAuthorization, authorizedRoute} from '../library/authentication';
import initInterceptors from '../interceptors';
import authorizedRoutesConfig from '../constants/authorizedRoutesConfig';
import {baseApiRoute} from '../../envVariables';
import roleConfig from '../../roleConfig';
import store from '../store';
import TopNav from './pieces/TopNav';
import Footer from './pieces/Footer';
import ViewWrapper from './ViewWrapper';

// Initialize global interceptors such as 401, 403
initInterceptors(baseApiRoute, 300);


let _viewListener;

const mapStateToProps = (state) => {
	return {
		'currentUser': state.user,
		'isAuthenticated': state.isAuthenticated
	}
}

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'showLoader': LoaderActions.showLoader,
		'hideLoader': LoaderActions.hideLoader,
		'setRedirect': UserActions.setRedirect,
		'setUser': UserActions.setUser
    }, dispatch);
};

class Layout extends React.Component {
	constructor() {
        super();

		this.state = {
			'waitingForInitialAuthCheck': true
		}

		this.onViewChange = this.onViewChange.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

	componentDidMount() {
		// Create an enhanced  that syncs navigation events with the store
		const history = syncHistoryWithStore(browserHistory, store);
		_viewListener = history.listen((location) => {
			this.onViewChange(location);
		});
	}

	componentWillUnmount() {
		_viewListener();
	}

	// TODO: Consider calling getMe route (to account for authenticated routes that don't have an API endpoint that would return a 401), then redirect
	onViewChange(location) {
		let destination = location.pathname;
		let restrictedRoute, accessGranted;
		if (this.state.waitingForInitialAuthCheck) {
			this.props.showLoader();
		}
		if (!this.props.isAuthenticated) {
			// Check for restriction on destination route
			restrictedRoute = authorizedRoute(authorizedRoutesConfig, destination);
			if (restrictedRoute) {
				this.showAlert('notAuthenticated');
				this.props.setRedirect(location.pathname);
				browserHistory.push('/login');
			} else {
				accessGranted = true;
			}
		} else {
			let homeState = this.props.currentUser.roleConfig ? this.props.currentUser.roleConfig.homeState : '/';
			this.props.setRedirect(homeState);
			restrictedRoute = authorizedRoute(authorizedRoutesConfig, destination);
			if (restrictedRoute) {
				accessGranted = checkAuthorization(restrictedRoute.accessControl, this.props.currentUser, roleConfig);
				if (!accessGranted) {
					this.showAlert('notAuthorized');
					browserHistory.push('/players/dashboard');
				}
			} else {
				accessGranted = true;
			}
		}
		if (this.state.waitingForInitialAuthCheck && accessGranted) {
			this.setState({
				'waitingForInitialAuthCheck': false
			}, () => {
				this.props.hideLoader();
			});
		} else {
			this.props.hideLoader();
		}
		return;
	}

	showAlert(selector) {
		const alerts = {
			'notAuthenticated': () => {
				this.props.addAlert({
					'title': 'Not Authenticated',
					'message': 'Please login or register to continue.',
					'type': 'error',
					'delay': 3000
				});
			},
			'notAuthorized': () => {
				this.props.addAlert({
					'title': 'Not Authorized',
					'message': 'Redirected: You do not have authorization to view this content.',
					'type': 'error',
					'delay': 3000
				});
			},
		}

		return alerts[selector]();
	}

    render() {
		let path = this.props.location.pathname;

	    return (
	      <div>
	        <header>
	            <TopNav></TopNav>
	        </header>
				<div className="site-background"></div>
				<div className="logo-banner row center">
			        <div className="logo">
						<Link key="home" to="/" className=""><img src="/images/BC_Web_Logo.png" alt="BattleComm" /></Link>
					</div>
			        <div className="mobile-logo">
						<Link key="home" to="/" className=""><img src="/images/BC_Web_Logo_mobile.png" alt="BattleComm" /></Link>
			        </div>
			    </div>
				{
					!this.state.waitingForInitialAuthCheck ?
					<Animation transitionName="view" transitionAppear={true} transitionAppearTimeout={250} transitionEnter={true} transitionEnterTimeout={250} transitionLeave={true} transitionLeaveTimeout={250} component='div' className='content-container'>
						{React.cloneElement(this.props.children, { key: path })}
					</Animation> :
					<div className="content-container"></div>
				}
				<Alerts></Alerts>
				<Loader></Loader>
	        <Footer></Footer>
	      </div>
	    );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Layout);
