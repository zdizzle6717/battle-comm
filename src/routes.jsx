'use strict';

import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Layout from './components/Layout';

import IndexPage from './components/pages/IndexPage';
import LoginPage from './components/pages/LoginPage';
import NotFoundPage from './components/pages/NotFoundPage';
import RegistrationPage from './components/pages/RegistrationPage';
// import ForgotPasswordPage from './components/pages/ForgotPasswordPage';
// import ResetPasswordPage from './components/pages/ResetPasswordPage';

// Admin
// import AdminDashboardPage from './components/pages/admin/AdminDashboardPage';
// import AssignPointsPage from './components/pages/admin/AssignPointsPage';
// import EditGameSystemPage from './components/pages/admin/EditGameSystemPage';
// import EditManufacturerPage from './components/pages/admin/EditManufacturerPage';
// import EditOrderPage from './components/pages/admin/EditOrderPage';
// import EditPlayerPage from './components/pages/admin/EditPlayerPage';
// import GameSystemListPage from './components/pages/admin/GameSystemListPage';
// import ManufacturerListPage from './components/pages/admin/ManufacturerListPage';
// import OrderListPage from './components/pages/admin/OrderListPage';
// import PlayerListPage from './components/pages/admin/PlayerListPage';
// import VenueDashboardPage from './components/pages/admin/VenueDashboardPage';

// News
// import NewsListPage from './components/pages/admin/NewsListPage';
// import NewsPostPage from './components/pages/admin/NewsPostPage';

// Players
// import PlayerAllySearchPage from './components/pages/admin/PlayerAllySearchPage';
// import PlayerChangePasswordPage from './components/pages/admin/PlayerChangePasswordPage';
// import PlayerDashboardPage from './components/pages/admin/PlayerDashboardPage';
// import PlayerNotificationsPage from './components/pages/admin/PlayerNotificationsPage';
// import PlayerProfilePage from './components/pages/admin/PlayerProfilePage';
// import PlayerRankingSearchPage from './components/pages/admin/PlayerRankingSearchPage';
// import PlayerSearchPage from './components/pages/admin/PlayerSearchPage';

// Store
// import CartPage from './components/pages/admin/CartPage';
// import CheckoutPage from './components/pages/admin/CheckoutPage';
// import OrderSuccessPage from './components/pages/admin/OrderSuccessPage';
// import ProductPage from './components/pages/admin/ProductPage';
// import StorePage from './components/pages/admin/StorePage';


const routes = (
  <Route path="/" component={Layout}>
    <IndexRoute component={IndexPage}/>
	<Route path="login" component={LoginPage}/>
    <Route path="register" component={RegistrationPage}/>



    <Route path="*" component={NotFoundPage}/>
  </Route>
);

export default routes;

// <Route path="admin">
// 	<IndexRoute component={AdminDashboardPage}/>
// 	<Route path="game-systems">
// 		<IndexRoute component={GameSystemListPage}/>
// 		<Route path="create" component={EditGameSystemPage}/>
// 		<Route path="edit/:gameSystemId" component={EditGameSystemPage}/>
// 	</Route>
// 	<Route path="manufacturers">
// 		<IndexRoute component={ManufacturerListPage}/>
// 		<Route path="create" component={EditManufacturerPage}/>
// 		<Route path="edit/:manufacturerId" component={EditManufacturerPage}/>
// 	</Route>
// 	<Route path="players">
// 		<IndexRoute component={PlayerListPage}/>
// 		<Route path="create" component={EditPlayerPage}/>
// 		<Route path="edit/:playerId" component={EditPlayerPage}/>
// 	</Route>
// 	<Route path="store">
// 		<IndexRoute component={OrderListPage}/>
// 		<Route path="order/create" component={EditOrderPage}/>
// 		<Route path="order/edit/:orderId" component={EditOrderPage}/>
// 		<Route path="products" component={ProductListPage}/>
// 		<Route path="products/create" component={EditProductPage}/>
// 		<Route path="products/edit/:productId" component={EditProductPage}/>
// 	</Route>
// 	<Route path="venue">
// 		<IndexRoute component={VenueDashboardPage}/>
// 		<Route path="assign-points" component={AssignPointsPage}/>
// 	</Route>
// </Route>
// <Route path="players">
// 	<IndexRoute component={PlayerSearchPage} />
// 	<Route path="profile/:playerId">
// 		<IndexRoute component={PlayerProfilePage} />
// 		<Route path="ally-list" component={PlayerAllySearchPage} />
// 	</Route>
// 	<Route path="dashboard/:playerId">
// 		<IndexRoute component={PlayerDashboardPage}/>
// 		<Route path="change-password" component={PlayerChangePasswordPage} />
// 		<Route path="notifications" component={PlayerNotificationsPage} />
// 	</Route>
// 	<Route path="ranking/search" component={PlayerRankingSearchPage} />
// </Route>
// <Route path="news">
// 	<IndexRoute component={NewsListPage}/>
// 	<Route path="post/:postId" component={NewsPostPage}/>
// </Route>
// <Route path="store">
// 	<IndexRoute component={StorePage}/>
// 	<Route path="cart" component={CartPage}/>
// 	<Route path="checkout" component={CheckoutPage}/>
// 	<Route path="product/:productId" component={ProductPage}/>
// 	<Route path="order-success" component={OrderSuccessPage}/>
// </Route>
// <Route path="forgot-password" component={ForgotPasswordPage}/>
// <Route path="password-reset" component={PasswordResetPage}/>
