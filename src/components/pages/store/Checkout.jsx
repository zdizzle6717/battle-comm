'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import {UserActions, checkAuthorization} from '../../../library/authentication';
import {handlers} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import {CartActions} from '../../../library/cart';
import PaymentService from '../../../services/PaymentService';
import ProductOrderService from '../../../services/ProductOrderService';
import ProductService from '../../../services/ProductService';
import roleConfig from '../../../../roleConfig';
import env from '../../../../envVariables';

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
		'modifyUser': UserActions.modifyUser,
		'updateStock': CartActions.updateStock,
	}, dispatch);
}

class Checkout extends React.Component {
    constructor() {
        super();

		this.state = {
			'pointsAfterPurchase': 0,
			'productOrder': {
				'productDetails': []
			},
			'stripeLoading': true,
			'userIsSubscriber': false
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.loadStripe = this.loadStripe.bind(this);
		this.openStripeModal = this.openStripeModal.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Checkout";
		let userIsSubscriber = checkAuthorization(['subscriber'], this.props.user, roleConfig);
		if (this.getOrderTotal.call(this, this.props.cartItems) <= 0) {
			this.showAlert('cartEmpty');
			this.props.history.push('/store');
		}
		let productOrder = {
			'status': 'processing',
			'customerFullName': (this.props.user.firstName && this.props.user.lastName) ? this.props.user.firstName + ' ' + this.props.user.lastName : '',
			'customerEmail': this.props.user.email || '',
			'shippingStreet': this.props.user.streetAddress || '',
			'shippingApartment': this.props.user.aptSuite || '',
			'shippingCity': this.props.user.city || '',
			'shippingState': this.props.user.state || '',
			'shippingZip': this.props.user.zip || ''
		}
		this.setState({
			'productOrder': productOrder,
			'userIsSubscriber': userIsSubscriber
		});

		if (!userIsSubscriber) {
			let self = this;

			this.loadStripe(() => {
				// Handler for acknowledging card token response
				let handlePurchaseSubmit = (token) => {
					let productsAndQty = this.props.cartItems.map((item) => {
						return {
							'id': item.product.id,
							'qty': item.cartQty
						};
					});
					ProductService.updateStock({
						'direction': 'decrement',
						'products': productsAndQty
					}).then((response) => {
						if (response.success) {
							let totalShippingCost = 0;
							this.props.cartItems.forEach((item) => {
								totalShippingCost += item.product.shippingCost * item.cartQty;
							});
							PaymentService.payShippingCost(this.props.user.id, {
								'token': JSON.stringify(token),
								'details': {
									'email': this.state.productOrder.customerEmail,
									'description': 'Reward Point Purchase',
									'shippingCost': totalShippingCost * 100
								}
							}).then((response) => {
								self.handleSubmit();
							}).catch((error) => {
								if (error.message === `Don't fuck with the machine!`) {
									this.showAlert('fuckOffHackers');
								}
								ProductService.updateStock({
									'direction': 'increment',
									'products': productsAndQty
								});
							});
						} else {
							response.products.forEach((product) => {
								this.props.updateStock(product.id, product.outOfStock);
							});
							this.showAlert('productsOutOfStock');
							this.props.history.push('/store/cart');
						}
					});
				};

	            this.stripehandler = window.StripeCheckout.configure({
	                'key': env.stripe.publishable,
	                'image': '/images/branding/128-logo.jpg',
	                'locale': 'auto',
	                'token': handlePurchaseSubmit
	            });

	            this.setState({
	                'stripeLoading': false
	            });
	        });
		}
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
		if (e) {
			e.preventDefault();
		}
		let productsAndQty = this.props.cartItems.map((item) => {
			return {
				'id': item.product.id,
				'qty': item.cartQty
			};
		});
		const completeOrder = () => {
			let order = Object.assign({
				'UserId': this.props.user.id,
				'orderTotal': this.getOrderTotal.call(this, this.props.cartItems)
			}, this.state.productOrder);
			let items = [...this.props.cartItems];
			order.productDetails = items.map((item) => {
				let product = item.product;
				product.qty = item.cartQty;
				return product;
			});
			ProductOrderService.create(order).then((response) => {
				this.showAlert('orderSuccess');
				setTimeout(() => {
					this.props.clearCart();
					this.props.modifyUser({
						'rewardPoints': this.props.user.rewardPoints - this.getOrderTotal(this.props.cartItems)
					});
				});
				this.props.history.push('/store/order-success');
			});
		}
		if (this.state.userIsSubscriber) {
			ProductService.updateStock({
				'direction': 'decrement',
				'products': productsAndQty
			}).then((response) => {
				if (response.success) {
					completeOrder();
				} else {
					response.products.forEach((product) => {
						this.props.updateStock(product.id, product.outOfStock);
					});
					this.showAlert('productsOutOfStock');
					this.props.history.push('/store/cart');
				}
			});
		} else {
			completeOrder();
		}
	}

	loadStripe(onload) {
        if(!window.StripeCheckout) {
            const script = document.createElement('script');
            script.onload = () => {
                onload();
            };
            script.src = 'https://checkout.stripe.com/checkout.js';
            document.head.appendChild(script);
        } else {
            onload();
        }
    }

	openStripeModal(e) {
		let totalShippingCost = 0;
		this.props.cartItems.forEach((item) => {
			totalShippingCost += item.product.shippingCost * item.cartQty;
		});
        this.stripehandler.open({
			'name': 'Battle-Comm',
            'description': 'Shipping Total',
			'amount': totalShippingCost * 100,
			'email': this.state.productOrder.customerEmail,
            'panelLabel': 'Complete Order',
			'zipCode': true
        });
        e.preventDefault();
    }

	showAlert(selector) {
		const alerts = {
			'cartEmpty': () => {
				this.props.addAlert({
					'title': 'Cart Is Empty',
					'message': 'Add some items to your cart to continue to checkout page.',
					'type': 'info',
					'delay': 3000
				});
			},
			'orderError': () => {
				this.props.addAlert({
					'title': 'Order Failed',
					'message': 'Something went wrong while trying to place your order.  Please refresh and try again or contact support.',
					'type': 'error',
					'delay': 4000
				});
			},
			'orderSuccess': () => {
				this.props.addAlert({
					'title': 'Order Success',
					'message': 'Your order was successfully submitted.  Please check your e-mail for more information.',
					'type': 'success',
					'delay': 4000
				});
			},
			'productsOutOfStock': () => {
				this.props.addAlert({
					'title': 'Products Out of Stock',
					'message': 'Some of the products in your cart are out of stock.  Please remove them from your cart to continue to checkout.',
					'type': 'alert',
					'delay': 5000
				});
			},
			'fuckOffHackers': () => {
				this.props.addAlert({
					'title': 'Fuck Off!',
					'message': `Hey hackers, don't fuck with the machine!`,
					'type': 'error',
					'delay': 10000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
		let formIsInvalid = getFormErrorCount(this.props.forms, 'productOrderForm') > 0;

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
						<Form name="productOrderForm" handleSubmit={this.handleSubmit} submitButton={false} customClass="push-bottom-2x" disable={this.props.user.rewardPoints - this.getOrderTotal.call(this, this.props.cartItems) < 0}>
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
						<div className="small-12 columns text-center">
							{
								!this.state.userIsSubscriber ?
								<div>
									{
										!this.state.stripeLoading &&
										<button className="button secondary" onClick={this.openStripeModal} disabled={formIsInvalid}>Finalize Order</button>
									}
								</div> :
								<button className="button secondary" onClick={this.handleSubmit} disabled={formIsInvalid}>Finalize Order</button>
							}
						</div>
						<div className="small-12 columns text-right">
							<h5>Current Reward Points: {this.props.user.rewardPoints}</h5>
							<h5>Order Total: {this.getOrderTotal.call(this, this.props.cartItems)}</h5>
							<h5>RP After Purchase: {this.props.user.rewardPoints - this.getOrderTotal.call(this, this.props.cartItems)}</h5>
						</div>
					</div>
					<div className="small-12 columns text-center">
						{
							!this.state.userIsSubscriber &&
							<div>
								<h4 className="color-secondary">All shipping costs are free for subscribers!  Follow the link to subscribe, then return to checkout to continue with free shipping.</h4>
								<Link to="/subscribe"><h3 className="button secondary push-top">Become a BC Subscriber?</h3></Link>
							</div>
						}
					</div>
					<div className="small-12 columns text-center push-top-2x">
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
