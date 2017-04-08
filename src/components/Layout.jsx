'use strict';

import React from 'react';
import {Link, browserHistory} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import Animation from 'react-addons-css-transition-group';
import TopNav from './pieces/TopNav';
import Footer from './pieces/Footer';
import {Alerts} from '../library/alerts'
import {Loader} from '../library/loader';
import {UserActions} from '../library/authentication';
import initInterceptors from '../interceptors';
import {baseApiRoute} from '../../envVariables';

// Initialize global interceptors such as 401, 403
initInterceptors(baseApiRoute, 300);

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'setUser': UserActions.setUser
	}, dispatch);
}

class Layout extends React.Component {
	constructor() {
        super();
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
				<Animation transitionName="view" transitionAppear={true} transitionAppearTimeout={250} transitionEnter={true} transitionEnterTimeout={250} transitionLeave={true} transitionLeaveTimeout={250} component='div' className='content-container'>
					{React.cloneElement(this.props.children, { key: path })}
				</Animation>
				<Alerts></Alerts>
				<Loader></Loader>
	        <Footer></Footer>
	      </div>
	    );
    }
}

export default connect(null, mapDispatchToProps)(Layout);
