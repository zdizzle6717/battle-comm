'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import { Link } from 'react-router-dom';
import {CSSTransitionGroup as Animation} from 'react-transition-group';
import PropTypes from 'prop-types';
import {CartActions} from '../../library/cart';

const mapStateToProps = (state) => {
	return {
		'cartItems': state.cartItems,
		'user': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addToCart': CartActions.add,
		'removeFromCart': CartActions.remove
	}, dispatch);
}

class CartSummary extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			'showCart': false
		}

		this.toggleCart = this.toggleCart.bind(this);
	}

	componentDidMount() {}

	getOrderTotal(items) {
		let total = 0;
		items.forEach((item) => {
			total += parseInt(item.product.price, 10) * parseInt(item.cartQty, 10);
		});
		return total;
	}

	removeItem(productId) {
		this.props.removeFromCart(productId);
	}

	toggleCart() {
		this.setState({
			'showCart': !this.state.showCart
		});
	}

	render() {
		return (
			<li className="mini-cart">
				<a className="menu-link cart-button" onClick={this.toggleCart}><span className="fa fa-shopping-cart"></span></a>
					<div className={this.state.showCart ? 'cart-summary show' : 'cart-summary'} >
						<div className="header">
							<h2>Cart Summary</h2>
							<span className="fa fa-times-circle-o pointer" onClick={this.toggleCart}></span>
						</div>
						<div className="body">
							{
								this.props.cartItems.length > 0 ?
								<table className="stack hover text-center">
									<thead>
										<tr>
											<th className="text-center">Name</th>
											<th className="text-center">Price</th>
											<th className="text-center">Qty</th>
											<th className="text-center">Remove?</th>
										</tr>
									</thead>
									<tbody>
										{
											this.props.cartItems.map((item, i) =>
												<tr key={i} className="item-row">
													<td>{`${item.product.name.substring(0, 15)}...`}</td>
													<td>{item.product.price} RP</td>
													<td>({item.cartQty})</td>
													<td className="pointer" onClick={this.removeItem.bind(this, item.product.id)}><span className="fa fa-times-circle-o"></span></td>
												</tr>
											)
										}
									</tbody>
								</table> :
								<h3 className="text-center push-top-2x">There are currently no items in the cart</h3>
							}
						</div>
						<div className="footer">
							<h5>Current Reward Points: <strong>{this.props.user.rewardPoints} RP</strong></h5>
							<h4>Order Total: <strong>{this.getOrderTotal.call(this, this.props.cartItems)} RP</strong></h4>
							<div className="actions" onClick={this.toggleCart}>
								<Link to="/store/cart" className="button primary">View Cart</Link>
								<Link to="/store/checkout" className="button secondary">Checkout</Link>
							</div>
						</div>
					</div>
			</li>

		)
	}
}

CartSummary.propTypes = {
	// 'cartItems': PropTypes.shape({
	//
	// })
}

CartSummary.defaultProps = {
}

export default connect(mapStateToProps, mapDispatchToProps)(CartSummary);
