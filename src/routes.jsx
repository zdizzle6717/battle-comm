'use strict';

import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Layout from './components/Layout';

import IndexPage from './components/pages/IndexPage';
import LoginPage from './components/pages/LoginPage';
import NotFoundPage from './components/pages/NotFoundPage';
import RegistrationPage from './components/pages/RegistrationPage';
import SubscribePage from './components/pages/SubscribePage';
import ForgotPasswordPage from './components/pages/ForgotPasswordPage';
import PasswordResetPage from './components/pages/PasswordResetPage';

// Admin
import AdminDashboardPage from './components/pages/admin/AdminDashboardPage';
import AssignPointsPage from './components/pages/admin/AssignPointsPage';
import EditGameSystemPage from './components/pages/admin/EditGameSystemPage';
import EditManufacturerPage from './components/pages/admin/EditManufacturerPage';
import EditNewsPostPage from './components/pages/admin/EditNewsPostPage';
import EditProductPage from './components/pages/admin/EditProductPage';
import EditProductOrderPage from './components/pages/admin/EditProductOrderPage';
import EditUserPage from './components/pages/admin/EditUserPage';
import SearchGameSystemsPage from './components/pages/admin/SearchGameSystemsPage';
import SearchManufacturersPage from './components/pages/admin/SearchManufacturersPage';
import SearchNewsPostsPage from './components/pages/admin/SearchNewsPostsPage';
import SearchProductsPage from './components/pages/admin/SearchProductsPage';
import SearchProductOrdersPage from './components/pages/admin/SearchProductOrdersPage';
import SearchUsersPage from './components/pages/admin/SearchUsersPage';

// News
import NewsPage from './components/pages/news/NewsPage';
import NewsPostPage from './components/pages/news/NewsPostPage';

// Players
import PlayerAccountEditPage from './components/pages/players/PlayerAccountEditPage';
import PlayerAllySearchPage from './components/pages/players/PlayerAllySearchPage';
import PlayerChangePasswordPage from './components/pages/players/PlayerChangePasswordPage';
import PlayerDashboardPage from './components/pages/players/PlayerDashboardPage';
import PlayerNotificationsPage from './components/pages/players/PlayerNotificationsPage';
import PlayerProfilePage from './components/pages/players/PlayerProfilePage';
import PlayerRankingSearchPage from './components/pages/players/PlayerRankingSearchPage';
import PlayerSearchPage from './components/pages/players/PlayerSearchPage';

// Store
import CartPage from './components/pages/store/CartPage';
import CheckoutPage from './components/pages/store/CheckoutPage';
import OrderSuccessPage from './components/pages/store/OrderSuccessPage';
import ProductPage from './components/pages/store/ProductPage';
import RewardPointPurchasePage from './components/pages/store/RewardPointPurchasePage';
import StorePage from './components/pages/store/StorePage';


const routes = (
  <Route path="/" component={Layout}>
    <IndexRoute component={IndexPage}/>
	<Route path="login" component={LoginPage}/>
    <Route path="register" component={RegistrationPage}/>
	<Route path="forgot-password" component={ForgotPasswordPage}/>
	<Route path="password-reset/:resetToken" component={PasswordResetPage}/>
	<Route path="admin">
		<IndexRoute component={AdminDashboardPage}/>
		<Route path="game-systems">
			<IndexRoute component={SearchGameSystemsPage}/>
			<Route path="create" component={EditGameSystemPage}/>
			<Route path="edit/:gameSystemId" component={EditGameSystemPage}/>
		</Route>
		<Route path="manufacturers">
			<IndexRoute component={SearchManufacturersPage}/>
			<Route path="create" component={EditManufacturerPage}/>
			<Route path="edit/:manufacturerId" component={EditManufacturerPage}/>
		</Route>
		<Route path="news">
			<IndexRoute component={SearchNewsPostsPage}/>
			<Route path="create" component={EditNewsPostPage}/>
			<Route path="edit/:postId" component={EditNewsPostPage}/>
		</Route>
		<Route path="product-orders">
			<IndexRoute component={SearchProductOrdersPage}/>
			<Route path="edit/:orderId" component={EditProductOrderPage}/>
		</Route>
		<Route path="products">
			<IndexRoute component={SearchProductsPage}/>
			<Route path="create" component={EditProductPage}/>
			<Route path="edit/:productId" component={EditProductPage}/>
		</Route>
		<Route path="venue">
			<IndexRoute component={AssignPointsPage}/>
			<Route path="assign-points" component={AssignPointsPage}/>
		</Route>
		<Route path="users">
			<IndexRoute component={SearchUsersPage}/>
			<Route path="edit/:userId" component={EditUserPage}/>
		</Route>
	</Route>
	<Route path="news">
		<IndexRoute component={NewsPage}/>
		<Route path="post/:postId" component={NewsPostPage}/>
	</Route>
	<Route path="players">
		<IndexRoute component={PlayerSearchPage} />
		<Route path="profile/:playerHandle">
			<IndexRoute component={PlayerProfilePage} />
			<Route path="ally-search" component={PlayerAllySearchPage} />
		</Route>
		<Route path="dashboard">
			<IndexRoute component={PlayerDashboardPage}/>
			<Route path="change-password" component={PlayerChangePasswordPage} />
			<Route path="account-edit" component={PlayerAccountEditPage} />
			<Route path="notifications" component={PlayerNotificationsPage} />
		</Route>
	</Route>
	<Route path="ranking/search/:gameSystemId(/:factionId)" component={PlayerRankingSearchPage} />
	<Route path="store">
		<IndexRoute component={StorePage}/>
		<Route path="cart" component={CartPage}/>
		<Route path="checkout" component={CheckoutPage}/>
		<Route path="products/:productId" component={ProductPage}/>
		<Route path="order-success" component={OrderSuccessPage}/>
	</Route>
    <Route path="*" component={NotFoundPage}/>
  </Route>
);

export default routes;
