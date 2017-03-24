'use strict';

import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Layout from './components/Layout';

import IndexPage from './components/pages/IndexPage';
import LoginPage from './components/pages/LoginPage';
import NotFoundPage from './components/pages/NotFoundPage';
import RegistrationPage from './components/pages/RegistrationPage';
import ForgotPasswordPage from './components/pages/ForgotPasswordPage';
import PasswordResetPage from './components/pages/PasswordResetPage';

// Admin
import AdminDashboardPage from './components/pages/admin/AdminDashboardPage';
import AssignPointsPage from './components/pages/admin/AssignPointsPage';
import EditGameSystemPage from './components/pages/admin/EditGameSystemPage';
import EditManufacturerPage from './components/pages/admin/EditManufacturerPage';
import EditNewsPostPage from './components/pages/admin/EditNewsPostPage';
import EditOrderPage from './components/pages/admin/EditOrderPage';
import EditPlayerPage from './components/pages/admin/EditPlayerPage';
import EditProductPage from './components/pages/admin/EditProductPage';
import SearchGameSystemsPage from './components/pages/admin/SearchGameSystemsPage';
import SearchManufacturersPage from './components/pages/admin/SearchManufacturersPage';
import SearchNewsPostsPage from './components/pages/admin/SearchNewsPostsPage';
import SearchProductOrdersPage from './components/pages/admin/SearchProductOrdersPage';
import SearchUsersPage from './components/pages/admin/SearchUsersPage';

// News
import NewsPage from './components/pages/news/NewsPage';
import NewsPostPage from './components/pages/news/NewsPostPage';

// Players
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
import StorePage from './components/pages/store/StorePage';


const routes = (
  <Route path="/" component={Layout}>
    <IndexRoute component={IndexPage}/>
	<Route path="login" component={LoginPage}/>
    <Route path="register" component={RegistrationPage}/>
	<Route path="forgot-password" component={ForgotPasswordPage}/>
	<Route path="password-reset" component={PasswordResetPage}/>
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
		<Route path="players">
			<IndexRoute component={SearchUsersPage}/>
			<Route path="create" component={EditPlayerPage}/>
			<Route path="edit/:playerId" component={EditPlayerPage}/>
		</Route>
		<Route path="store">
			<IndexRoute component={SearchProductOrdersPage}/>
			<Route path="order/create" component={EditOrderPage}/>
			<Route path="order/edit/:orderId" component={EditOrderPage}/>
			<Route path="products" component={SearchProductOrdersPage}/>
			<Route path="products/create" component={EditProductPage}/>
			<Route path="products/edit/:productId" component={EditProductPage}/>
		</Route>
		<Route path="venue">
			<IndexRoute component={AssignPointsPage}/>
			<Route path="assign-points" component={AssignPointsPage}/>
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
			<Route path="ally-list" component={PlayerAllySearchPage} />
		</Route>
		<Route path="dashboard/:playerId">
			<IndexRoute component={PlayerDashboardPage}/>
			<Route path="change-password" component={PlayerChangePasswordPage} />
			<Route path="notifications" component={PlayerNotificationsPage} />
		</Route>
		<Route path="ranking/search" component={PlayerRankingSearchPage} />
	</Route>
	<Route path="store">
		<IndexRoute component={StorePage}/>
		<Route path="cart" component={CartPage}/>
		<Route path="checkout" component={CheckoutPage}/>
		<Route path="product/:productId" component={ProductPage}/>
		<Route path="order-success" component={OrderSuccessPage}/>
	</Route>
    <Route path="*" component={NotFoundPage}/>
  </Route>
);

export default routes;
