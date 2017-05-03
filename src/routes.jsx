'use strict';

// Routes
import Home from './components/pages/Home';
import AdminDashboard from './components/pages/admin/AdminDashboard';
	import SearchGameSystems from './components/pages/admin/SearchGameSystems';
		import EditGameSystem from './components/pages/admin/EditGameSystem';
	import SearchManufacturers from './components/pages/admin/SearchManufacturers';
		import EditManufacturer from './components/pages/admin/EditManufacturer';
	import SearchNewsPosts from './components/pages/admin/SearchNewsPosts';
		import EditNewsPost from './components/pages/admin/EditNewsPost';
	import SearchProductOrders from './components/pages/admin/SearchProductOrders';
		import EditProductOrder from './components/pages/admin/EditProductOrder';
	import SearchProducts from './components/pages/admin/SearchProducts';
		import EditProduct from './components/pages/admin/EditProduct';
	import AssignPoints from './components/pages/admin/AssignPoints';
	import SearchUsers from './components/pages/admin/SearchUsers';
		import EditUser from './components/pages/admin/EditUser';
import ForgotPassword from './components/pages/ForgotPassword';
import Login from './components/pages/Login';
import NotFound from './components/pages/NotFound';
import News from './components/pages/news/News';
	import NewsPost from './components/pages/news/NewsPost';
import PlayerRankingSearch from './components/pages/players/PlayerRankingSearch';
import PlayerSearch from './components/pages/players/PlayerSearch';
	import PlayerProfile from './components/pages/players/PlayerProfile';
		import PlayerAllySearch from './components/pages/players/PlayerAllySearch';
	import PlayerDashboard from './components/pages/players/PlayerDashboard';
		import PlayerChangePassword from './components/pages/players/PlayerChangePassword';
		import PlayerAccountEdit from './components/pages/players/PlayerAccountEdit';
		import PlayerNotifications from './components/pages/players/PlayerNotifications';
import Register from './components/pages/Register';
import ResetPassword from './components/pages/ResetPassword';
import Subscribe from './components/pages/Subscribe';
import Store from './components/pages/store/Store';
	import Cart from './components/pages/store/Cart';
	import Checkout from './components/pages/store/Checkout';
	import OrderSuccess from './components/pages/store/OrderSuccess';
	import Product from './components/pages/store/Product';

// Actions


let routes = [
	// Index/Home
	{
		'path': '/',
		'component': Home,
		'exact': true
	},

	// Admin
	{
		'path': '/admin',
		'component': AdminDashboard,
		'exact': true,
		'access': ['tourneyAdmin', 'eventAdmin', 'venueAdmin', 'newsContributor']
	},
	{
		'path': '/admin/game-systems',
		'component': SearchGameSystems,
		'exact': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/game-systems/create',
		'component': EditGameSystem,
		'strict': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/game-systems/edit/:gameSystemId',
		'component': EditGameSystem,
		'strict': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/manufacturers',
		'component': SearchManufacturers,
		'exact': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/manufacturers/create',
		'component': EditManufacturer,
		'strict': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/manufacturers/edit/:manufacturerId',
		'component': EditManufacturer,
		'strict': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/news',
		'component': SearchNewsPosts,
		'exact': true,
		'access': ['newsContributor']
	},
	{
		'path': '/admin/news/create',
		'component': EditNewsPost,
		'strict': true,
		'access': ['newsContributor']
	},
	{
		'path': '/admin/news/edit/:postId',
		'component': EditNewsPost,
		'strict': true,
		'access': ['newsContributor']
	},
	{
		'path': '/admin/product-orders',
		'component': SearchProductOrders,
		'exact': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/product-orders/edit/:orderId',
		'component': EditProductOrder,
		'strict': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/products',
		'component': SearchProducts,
		'exact': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/products/create',
		'component': EditProduct,
		'strict': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/products/edit/:productId',
		'component': EditProduct,
		'strict': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/venue',
		'component': AssignPoints,
		'exact': true,
		'access': ['venueAdmin']
	},
	{
		'path': '/admin/venue/assign-points',
		'component': AssignPoints,
		'access': ['venueAdmin']
	},
	{
		'path': '/admin/users',
		'component': SearchUsers,
		'exact': true,
		'access': ['systemAdmin']
	},
	{
		'path': '/admin/users/edit/:userId',
		'component': EditUser,
		'strict': true,
		'access': ['systemAdmin']
	},

	// Public...
	{
		'path': '/forgot-password',
		'component': ForgotPassword,
		'exact': true
	},
	{
		'path': '/login',
		'component': Login,
		'exact': true
	},

	// News
	{
		'path': '/news',
		'component': News,
		'exact': true
	},
	{
		'path': '/news/post/:postId',
		'component': NewsPost
	},

	// Public cont...
	{
		'path': '/ranking/search/:gameSystemId',
		'component': PlayerRankingSearch,
		'exact': true,
		'strict': true
	},
	{
		'path': '/ranking/search/:gameSystemId/:factionId',
		'component': PlayerRankingSearch,
		'exact': true,
		'strict': true
	},
	{
		'path': '/register',
		'component': Register,
		'exact': true
	},

	// Players
	{
		'path': '/players',
		'component': PlayerSearch,
		'exact': true
	},
	{
		'path': '/players/dashboard',
		'component': PlayerDashboard,
		'exact': true,
		'strict': true,
		'access': ['member']
	},
	{
		'path': '/players/dashboard/account-edit',
		'component': PlayerAccountEdit,
		'access': ['member']
	},
	{
		'path': '/players/dashboard/change-password',
		'component': PlayerChangePassword,
		'access': ['member']
	},
	{
		'path': '/players/dashboard/notifications',
		'component': PlayerNotifications,
		'access': ['member']
	},
	{
		'path': '/players/profile/:playerHandle',
		'component': PlayerProfile,
		'strict': true,
		'exact': true
	},
	{
		'path': '/players/profile/:playerHandle/ally-search',
		'component': PlayerAllySearch
	},

	// Public cont...
	{
		'path': '/reset-password',
		'component': ResetPassword,
		'exact': true
	},

	// Store
	{
		'path': '/store',
		'component': Store,
		'exact': true
	},
	{
		'path': '/store/cart',
		'component': Cart,
		'access': ['member']
	},
	{
		'path': '/store/checkout',
		'component': Checkout,
		'access': ['member']
	},
	{
		'path': '/store/order-success',
		'component': OrderSuccess,
		'access': ['member']
	},
	{
		'path': '/store/products/:productId',
		'component': Product
	},

	// Public cont...
	{
		'path': '/subscribe',
		'component': Subscribe,
		'exact': true
	},

	// If no route matches, return NotFound component
	{
		'component': NotFound
	}
];

export default routes;
