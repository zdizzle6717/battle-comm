import React from 'react'
import { Route, Switch, Redirect, Link, withRouter } from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import Animation from 'react-addons-css-transition-group';
import {configureAuthRoute} from '../library/authentication';
import {RedirectWithStatus} from '../library/routing';
import {Alerts} from '../library/alerts'
import {Loader} from '../library/loader';
import {scrollTo} from '../library/utilities';
import {UserActions} from '../library/authentication';
import TopNav from './pieces/TopNav';
import Footer from './pieces/Footer';
import initInterceptors from '../interceptors';
import roleConfig from '../../roleConfig';
import {googleAnalyticsKey, baseApiRoute} from '../../envVariables';
import ReactGA from 'react-ga';
const AuthRoute = configureAuthRoute(roleConfig);
import routes from '../routes';

let _viewListener;

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'setUser': UserActions.setUser
	}, dispatch);
}

class Layout extends React.Component {
	constructor() {
        super();

		this.state = {
			'clientHasLoaded': false
		}

		this.onViewChange = this.onViewChange.bind(this);
    }

	componentWillMount() {
		// TODO: Check if this should be initialized in index with history passed as argument
		// Initialize global interceptors such as 401, 403
		initInterceptors(this.props.history, baseApiRoute, 300, );
		_viewListener = this.props.history.listen((location, action) => {
			this.onViewChange(location);
		});
	}

	componentDidMount() {
		this.setState({
			'clientHasLoaded': true
		});
		ReactGA.initialize(googleAnalyticsKey);
	}

	onViewChange(location) {
		scrollTo(0, 250);
		if (typeof(window) !== 'undefined') {
			ReactGA.set({ 'page': window.location.pathname });
			ReactGA.pageview(window.location.pathname);
		}
	}

	// TODO: Animation between view change is not working when wrapped around a Switch
    render() {
		return (
			<div>
				<header>
					<TopNav/>
				</header>
				
				<div className="site-background"></div>
				<div className="logo-banner row center">
			        <div className="logo">
						<Link to="/" className=""><img src="/images/BC_Web_Logo.png" alt="BattleComm" /></Link>
					</div>
			        <div className="mobile-logo">
						<Link to="/" className=""><img src="/images/BC_Web_Logo_mobile.png" alt="BattleComm" /></Link>
			        </div>
			    </div>
				{
					this.state.clientHasLoaded &&
					<Animation transitionName="view" transitionAppear={true} transitionAppearTimeout={250} transitionEnter={true} transitionEnterTimeout={250} transitionLeave={true} transitionLeaveTimeout={250} component='div' className='content-container'>
						<Switch>
							{routes.map((route, i) => {
								if (route.access) {
									return (
										<AuthRoute location={this.props.location} key={i} {...route}/>
									)
								} else {
									return (
										<Route location={this.props.location} key={i} {...route}/>
									)
								}
							})}
							<RedirectWithStatus location={this.props.location} from="/redirect" to="/" />
						</Switch>
					</Animation>
				}
				<Alerts></Alerts>
				<Loader></Loader>

				<Footer></Footer>
			</div>
		)
	}

	componentWillUnmount() {
		_viewListener();
	}
}

export default withRouter(connect(null, mapDispatchToProps)(Layout));
