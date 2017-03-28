'use strict';

import {combineReducers} from 'redux';
import {routerReducer as routing} from 'react-router-redux';

// Library
import {alerts} from '../library/alerts';
import {forms} from '../library/validations';
import {loader} from '../library/loader';
import {user, users, isAuthenticated, redirectRoute} from '../library/authentication';

// App
import {cartItems, cartTotal} from './cartItems';
import {gameSystem, gameSystems} from './gameSystems';
import {gameSystemRanking, gameSystemRankings} from './gameSystemRankings';
import {faction, factions} from './factions';
import {factionRanking, factionRankings} from './factionRankings';
import {newsPost, newsPosts} from './newsPosts';
import {manufacturer, manufacturers} from './manufacturers';
import {product, products} from './products';
import {productOrder, productOrders} from './productOrders';
import {userAchievement, userAchievements} from './userAchievements';
import {userMessage, userMessages} from './userMessages';
import {userNotification, userNotifications} from './userNotifications';
import {userPhoto, userPhotos} from './userPhotos';


export default combineReducers({
	routing,

	// library
	alerts,
	forms,
	isAuthenticated,
	loader,
	redirectRoute,
	user,
	users,

	// App
	cartItems,
	cartTotal,
	gameSystem,
	gameSystems,
	gameSystemRanking,
	gameSystemRankings,
	faction,
	factions,
	factionRanking,
	factionRankings,
	manufacturer,
	manufacturers,
	newsPost,
	newsPosts,
	product,
	products,
	productOrder,
	productOrders,
	userAchievement,
	userAchievements,
	userMessage,
	userMessages,
	userNotification,
	userNotifications,
	userPhoto,
	userPhotos
});
