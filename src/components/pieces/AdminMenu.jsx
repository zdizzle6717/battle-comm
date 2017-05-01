'use strict';

import React from 'react';
import {Link} from 'react-router';
import roleConfig from '../../../roleConfig';
import createAccessControl from '../../library/authentication/components/AccessControl';
const AccessControl = createAccessControl(roleConfig);

export default class AdminMenu extends React.Component {
	constructor() {
		super();

	}

	render() {
		return (
			<div className="admin-menu">
				<div className="menu-item">
					<Link to="/admin" className="button"> <span className="fa fa-indent"> </span> Admin Dashboard</Link>
				</div>
				<AccessControl customClasses="menu-item" access={['systemAdmin']}>
					<Link to="/admin/game-systems" className="button"> <span className="fa fa-gamepad"> </span> Game Systems</Link>
				</AccessControl>
				<AccessControl customClasses="menu-item" access={['systemAdmin']}>
					<Link to="/admin/manufacturers" className="button"> <span className="fa fa-industry"> </span> Manufacturers</Link>
				</AccessControl>
				<AccessControl customClasses="menu-item" access={['newsContributor']}>
					<Link to="/admin/news" className="button"> <span className="fa fa-newspaper-o"> </span> News</Link>
				</AccessControl>
				<AccessControl customClasses="menu-item" access={['systemAdmin']}>
					<Link to="/admin/users" className="button"> <span className="fa fa-users"> </span> Players</Link>
				</AccessControl>
				<AccessControl customClasses="menu-item" access={['systemAdmin']}>
					<Link to="/admin/products" className="button"> <span className="fa fa-shopping-bag"> </span> Products</Link>
				</AccessControl>
				<AccessControl customClasses="menu-item" access={['systemAdmin']}>
					<Link to="/admin/product-orders" className="button"> <span className="fa fa-shopping-cart"> </span> Orders</Link>
				</AccessControl>
				<AccessControl customClasses="menu-item" access={['venueAdmin']}>
					<Link to="/admin/venue" className="button"> <span className="fa fa-street-view"> </span> Venue</Link>
				</AccessControl>
			</div>
		)
	}
}
