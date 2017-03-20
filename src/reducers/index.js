'use strict';

import {combineReducers} from 'redux';
import {routerReducer as routing} from 'react-router-redux';
import {productOrder, productOrders} from './productOrders';
import {product, products} from './products';
import {alerts} from '../library/alerts';
import {user, users, isAuthenticated, redirectRoute} from '../library/authentication';
import {loader} from '../library/loader';
import {forms} from '../library/validations';

export default combineReducers({
	productOrder,
	productOrders,
	routing,
	product,
	products,

	// library
	alerts,
	forms,
	isAuthenticated,
	loader,
	redirectRoute,
	user,
	users
});
