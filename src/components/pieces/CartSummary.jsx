'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import { Link } from 'react-router';
import Animation from 'react-addons-css-transition-group';
import PropTypes from 'prop-types';
import CartActions from '../../actions/CartActions';

const mapStateToProps = (state) => {
	return {
		'cartTotal': state.cartTotal,
		'cartItems': state.cartItems
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'updateOrderTotal': CartActions.updateTotal,
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

	componentDidMount() {
		if (this.props.cartItems.length < 1) {
			let storedItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
			storedItems.forEach((item) => {
				this.props.addToCart(item.product, item.cartQty);
			});
			// TODO: Check if this needs a set timeout
			setTimeout(() => {
				this.props.updateOrderTotal(this.props.cartItems);
			});
		}
	}

	removeItem(item, qty) {
		this.props.removeFromCart(item.product.id, qty);
		// TODO: Check if this needs a set timeout
		setTimeout(() => {
			this.props.updateOrderTotal(this.props.cartItems);
		});
	}

	toggleCart() {
		this.setState({
			'showCart': !this.state.showCart
		});
	}

	render() {
		console.log(this.props.cartItems);
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
								<table className="text-center">
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
													<td>{item.product.price}</td>
													<td>({item.cartQty})</td>
													<td className="pointer" onClick={this.removeItem.bind(this, item, item.cartQty)}><span className="fa fa-minus"></span></td>
												</tr>
											)
										}
									</tbody>
								</table> :
								<h3 className="text-center push-top-2x">There are currently no items in the cart</h3>
							}
						</div>
						<div className="footer">
							<h4>Order Total: ${this.props.cartTotal}</h4>
							<div className="actions">
								<Link to="store/cart" className="button primary">View Cart</Link>
								<Link to="store/checkout" className="button secondary">Checkout</Link>
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
