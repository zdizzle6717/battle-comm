'use strict';

import React from 'react';
import {Router, browserHistory} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import routes from '../routes';
import scrollTo from '../library/utilities/scrollTo';
import {googleAnalyticsKey} from '../../envVariables';
import ReactGA from 'react-ga';
ReactGA.initialize(googleAnalyticsKey);

export default class AppRoutes extends React.Component {
	constructor() {
		super();
	}

	handleRouteUpdate() {
		scrollTo(0, 0);
		ReactGA.set({ 'page': window.location.pathname });
		ReactGA.pageview(window.location.pathname);
	}

	render() {
		return (
			<Router history={browserHistory} routes={routes} onUpdate={this.handleRouteUpdate}/>
		)
	}
}
