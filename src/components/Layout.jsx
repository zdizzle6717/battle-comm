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

// Routes
import Home from './pages/Home';
import AdminDashboard from './pages/admin/AdminDashboard';
	import SearchGameSystems from './pages/admin/SearchGameSystems';
		import EditGameSystem from './pages/admin/EditGameSystem';
	import SearchManufacturers from './pages/admin/SearchManufacturers';
		import EditManufacturer from './pages/admin/EditManufacturer';
	import SearchNewsPosts from './pages/admin/SearchNewsPosts';
		import EditNewsPost from './pages/admin/EditNewsPost';
	import SearchProductOrders from './pages/admin/SearchProductOrders';
		import EditProductOrder from './pages/admin/EditProductOrder';
	import SearchProducts from './pages/admin/SearchProducts';
		import EditProduct from './pages/admin/EditProduct';
	import AssignPoints from './pages/admin/AssignPoints';
	import SearchUsers from './pages/admin/SearchUsers';
		import EditUser from './pages/admin/EditUser';
import ForgotPassword from './pages/ForgotPassword';
import Login from './pages/Login';
import NotFound from './pages/NotFound';
import News from './pages/news/News';
	import NewsPost from './pages/news/NewsPost';
import PlayerRankingSearch from './pages/players/PlayerRankingSearch';
import PlayerSearch from './pages/players/PlayerSearch';
	import PlayerProfile from './pages/players/PlayerProfile';
		import PlayerAllySearch from './pages/players/PlayerAllySearch';
	import PlayerDashboard from './pages/players/PlayerDashboard';
		import PlayerChangePassword from './pages/players/PlayerChangePassword';
		import PlayerAccountEdit from './pages/players/PlayerAccountEdit';
		import PlayerNotifications from './pages/players/PlayerNotifications';
import Register from './pages/Register';
import ResetPassword from './pages/ResetPassword';
import Subscribe from './pages/Subscribe';
import Store from './pages/store/Store';
	import Cart from './pages/store/Cart';
	import Checkout from './pages/store/Checkout';
	import OrderSuccess from './pages/store/OrderSuccess';
	import Product from './pages/store/Product';


let _viewListener;

// TODO: Animation between view change is not working when wrapped around a Switch

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'setUser': UserActions.setUser
	}, dispatch);
}

class Layout extends React.Component {
	constructor() {
        super();

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
		ReactGA.initialize(googleAnalyticsKey);
	}

	onViewChange(location) {
		scrollTo(0, 250);
		if (typeof(window) !== 'undefined') {
			ReactGA.set({ 'page': window.location.pathname });
			ReactGA.pageview(window.location.pathname);
		}
	}

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

				<Animation transitionName="view" transitionAppear={true} transitionAppearTimeout={250} transitionEnter={true} transitionEnterTimeout={250} transitionLeave={true} transitionLeaveTimeout={250} component='div' className='content-container'>
					<Switch>
						<Route location={this.props.location} path="/" exact component={Home}/>
						<AuthRoute access={['tourneyAdmin', 'eventAdmin', 'venueAdmin', 'newsContributor']} location={this.props.location} path="/admin" exact component={AdminDashboard}/>
							<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/game-systems" exact component={SearchGameSystems}/>
								<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/game-systems/create" component={EditGameSystem}/>
								<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/game-systems/edit/:gameSystemId" component={EditGameSystem}/>
							<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/manufacturers" exact component={SearchManufacturers}/>
								<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/manufacturers/create" component={EditManufacturer}/>
								<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/manufacturers/edit/:manufacturerId" component={EditManufacturer}/>
							<AuthRoute access={['newsContributor']} location={this.props.location} path="/admin/news" exact component={SearchNewsPosts}/>
								<AuthRoute access={['newsContributor']} location={this.props.location} path="/admin/news/create" component={EditNewsPost}/>
								<AuthRoute access={['newsContributor']} location={this.props.location} path="/admin/news/edit/:postId" component={EditNewsPost}/>
							<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/product-orders" exact component={SearchProductOrders}/>
								<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/product-orders/edit/:orderId" strict component={EditProductOrder}/>
							<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/products" exact component={SearchProducts}/>
								<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/products/create" strict component={EditProduct}/>
								<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/products/edit/:productId" strict component={EditProduct}/>
							<AuthRoute access={['venueAdmin']} location={this.props.location} path="/admin/venue" exact component={AssignPoints}/>
								<AuthRoute access={['venueAdmin']} location={this.props.location} path="/admin/venue/assign-points" component={AssignPoints}/>
							<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/users" exact component={SearchUsers}/>
								<AuthRoute access={['systemAdmin']} location={this.props.location} path="/admin/users/edit/:userId" strict component={EditUser}/>
						<Route location={this.props.location} path="/forgot-password" exact component={ForgotPassword}/>
						<Route location={this.props.location} path="/login" exact component={Login}/>
						<Route location={this.props.location} path="/news" exact component={News}/>
							<Route location={this.props.location} path="/news/post/:postId" component={News}/>
						<RedirectWithStatus location={this.props.location} status={301} from="/redirect" to="/"/>
						<Route location={this.props.location} strict exact path="/ranking/search/:gameSystemId" component={PlayerRankingSearch}/>
						<Route location={this.props.location} strict exact path="/ranking/search/:gameSystemId/:factionId" component={PlayerRankingSearch}/>
						<Route location={this.props.location} path="/register" exact component={Register}/>
						<Route location={this.props.location} path="/players" exact component={PlayerSearch}/>
							<Route location={this.props.location} strict path="/players/profile/:playerHandle" component={PlayerProfile}/>
								<Route location={this.props.location} path="/players/profile/:playerHandle/ally-search" component={PlayerAllySearch}/>
							<AuthRoute access={['member']} location={this.props.location} strict path="/players/dashboard" component={PlayerDashboard}/>
								<AuthRoute access={['member']} location={this.props.location} path="/players/dashboard/change-password" component={PlayerChangePassword}/>
								<AuthRoute access={['member']} location={this.props.location} path="/players/dashboard/account-edit" component={PlayerAccountEdit}/>
								<AuthRoute access={['member']} location={this.props.location} path="/players/dashboard/notifications" component={PlayerNotifications}/>
						<Route location={this.props.location} path="/reset-password" exact component={ResetPassword}/>
						<Route location={this.props.location} path="/store" exact component={Store}/>
							<AuthRoute access={['member']} location={this.props.location} path="/store/cart" component={Cart}/>
							<AuthRoute access={['member']} location={this.props.location} path="/store/checkout" component={Checkout}/>
							<AuthRoute access={['member']} location={this.props.location} path="/store/order-success" component={OrderSuccess}/>
							<Route location={this.props.location} path="/store/products/:productId" component={Product}/>
						<Route location={this.props.location} path="/subscribe" exact component={Subscribe}/>
						<Route location={this.props.location} component={NotFound}/>
					</Switch>
				</Animation>

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
