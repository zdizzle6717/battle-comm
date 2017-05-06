'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import {UserActions} from '../../../library/authentication';
import {handlers} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import CartActions from '../../../actions/CartActions';
import ProductOrderService from '../../../services/ProductOrderService';

let _redirected = false;

const mapStateToProps = (state) => {
	return {
		'forms': state.forms,
		'user': state.user,
		'cartItems': state.cartItems
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'clearCart': CartActions.clearCart,
		'modifyUser': UserActions.modifyUser
	}, dispatch);
}

class Checkout extends React.Component {
    constructor() {
        super();

		this.state = {
			'pointsAfterPurchase': 0,
			'productOrder': {
				'productDetails': []
			}
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Checkout";
		if (this.getOrderTotal.call(this, this.props.cartItems) <= 0) {
			this.showAlert('cartEmpty');
			this.props.history.push('/store');
		}
		let productOrder = {
			'status': 'processing',
			'customerFullName': this.props.user.firstName + ' ' + this.props.user.lastName,
			'customerEmail': this.props.user.email
		}
		this.setState({
			'productOrder': productOrder
		});
    }

	componentWillReceiveProps(nextProps) {
		if (nextProps.cartItems.length !== this.props.cartItems.length) {
			if (!_redirected && this.getOrderTotal.call(this, nextProps.cartItems) <= 0) {
				_redirected = true;
				this.showAlert('cartEmpty');
				this.props.history.push('/store');
			}
		}
	}

	getOrderTotal(items) {
		let total = 0;
		items.forEach((item) => {
			total += parseInt(item.product.price, 10) * parseInt(item.cartQty, 10);
		});
		return total;
	}

	handleInputChange(e) {
		e.preventDefault();
		this.setState({
			'productOrder': handlers.updateInput(e, this.state.productOrder)
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		// TODO: First update product stockQty
		let order = Object.assign({
			'UserId': this.props.user.id,
			'orderTotal': this.getOrderTotal.call(this, this.props.cartItems)
		}, this.state.productOrder);
		let items = [...this.props.cartItems];
		order.productDetails = items.map((item) => {
			let product = item.product;
			product.qty = item.cartQty;
			return product;
		})
		ProductOrderService.create(order).then((response) => {
			this.showAlert('orderSuccess');
			this.props.clearCart();
			this.props.modifyUser({
				'rewardPoints': this.props.user.rewardPoints - this.getOrderTotal(this.props.cartItems)
			});
			this.props.history.push('/store/order-success');
		})
	}

	showAlert(selector) {
		const alerts = {
			'orderSuccess': () => {
				this.props.addAlert({
					'title': 'Order Success',
					'message': 'Your order was successfully submitted. Please check your e-mail for more information.',
					'type': 'success',
					'delay': 3000
				});
			},
			'cartEmpty': () => {
				this.props.addAlert({
					'title': 'Cart Is Empty',
					'message': 'Add some items to your cart to continue to checkout page.',
					'type': 'info',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Checkout.png" headerAlt="Checkout">
                <div className="row">
					<div className="small-12 columns">
						{
							this.props.user.rewardPoints - this.getOrderTotal.call(this, this.props.cartItems) < 0 &&
							<div className="small-12 columns text-center">
								<h3 className="color-alert">You do not have enough Reward Points for this purchase.</h3>
								<Link to="/store/cart">Return to cart?</Link>
							</div>
						}
						<Form name="productOrderForm" handleSubmit={this.handleSubmit} submitText="Finalize Order" customClass="push-bottom-2x" disable={this.props.user.rewardPoints - this.getOrderTotal.call(this, this.props.cartItems) < 0}>
							<div className="row">
								<div className="form-group small-12 medium-4 columns">
									<label className="required">Full Name</label>
									<Input type="text" name="customerFullName" value={this.state.productOrder.customerFullName} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-4 columns">
									<label className="required">E-mail</label>
									<Input type="text" name="customerEmail" value={this.state.productOrder.customerEmail} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-4 columns">
									<label>Phone</label>
									<Input type="text" name="phone" value={this.state.productOrder.phone} handleInputChange={this.handleInputChange} validate="domesticPhone"/>
								</div>
							</div>
							<h3>Shipping Address</h3>
							<div className="row">
								<div className="form-group small-12 medium-10 columns">
									<label className="required">Street</label>
									<Input type="text" name="shippingStreet" value={this.state.productOrder.shippingStreet} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-2 columns">
									<label>Apt/Suite</label>
									<Input type="text" name="shippingApartment" value={this.state.productOrder.shippingApartment} handleInputChange={this.handleInputChange}/>
								</div>
							</div>
							<div className="row">
								<div className="form-group small-12 medium-3 columns">
									<label className="required">City</label>
									<Input type="text" name="shippingCity" value={this.state.productOrder.shippingCity} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-3 columns">
									<label className="required">State</label>
									<Input type="text" name="shippingState" value={this.state.productOrder.shippingState} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-3 columns">
									<label className="required">Zipcode</label>
									<Input type="text" name="shippingZip" value={this.state.productOrder.shippingZip} handleInputChange={this.handleInputChange} validate="zipcode" required={true}/>
								</div>
								<div className="form-group small-12 medium-3 columns">
									<label className="required">Country</label>
									<Select type="text" name="shippingCountry" value={this.state.productOrder.shippingCountry} handleInputChange={this.handleInputChange} required={true}>
										<option value="">--Select--</option>
										<option value="US">United States</option>
									</Select>
								</div>
							</div>
							<div className="row">
								<div className="small-12 columns">
									<label>Order Details (Add a note specific to your order)</label>
									<TextArea name="orderDetails" value={this.state.productOrder.orderDetails || ''} rows="4" handleInputChange={this.handleInputChange}></TextArea>
								</div>
							</div>
						</Form>
						<div className="small-12 columns text-right">
							<h5>Current Reward Points: {this.props.user.rewardPoints}</h5>
							<h5>Order Total: {this.getOrderTotal.call(this, this.props.cartItems)}</h5>
							<h5>RP After Purchase: {this.props.user.rewardPoints - this.getOrderTotal.call(this, this.props.cartItems)}</h5>
						</div>
					</div>
					<div className="small-12 columns text-center">
						<Link to="/store/cart" className="button">
							Back to Cart
						</Link>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Checkout));
