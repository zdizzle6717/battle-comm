'use strict';

import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Layout from './components/Layout';
import IndexPage from './components/pages/IndexPage';
import LoginPage from './components/pages/LoginPage';
import NotFoundPage from './components/pages/NotFoundPage';
import RegistrationPage from './components/pages/RegistrationPage';

// Admin

// News

// Players

// Store


const routes = (
  <Route path="/" component={Layout}>
    <IndexRoute component={IndexPage}/>
	<Route path="login" component={LoginPage}/>
    <Route path="register" component={RegistrationPage}/>

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
	// 	<IndexRoute component={PlayerPage} />
	// 	<Route path="profile/:playerId">
	// 		<IndexRoute component={PlayerProfilePage} />
	// 		<Route path="ally-list" component={PlayerAllyListPage} />
	// 	</Route>
	// 	<Route path="dashboard/:playerId">
	// 		<IndexRoute component={PlayerDashboardPage}/>
	// 		<Route path="change-password" component={PlayerChangePasswordPage} />
	// 		<Route path="notifications" component={PlayerNotificationsPage} />
	// 	</Route>
	// 	<Route path="search" component={PlayerSearchPage} />
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

    <Route path="*" component={NotFoundPage}/>
  </Route>
);

export default routes;
