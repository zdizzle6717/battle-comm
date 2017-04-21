'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import {UserActions} from '../../../library/authentication';
import {handlers} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import ProductOrderService from '../../../services/ProductOrderService';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms,
		'user': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class CheckoutPage extends React.Component {
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
		this.setState({
			'pointsAfterPurchase': parseInt(this.props.user.rewardPoints, 10) - parseInt(this.props.cartTotal, 10)
		});
		let productOrder = {
			'status': 'processing',
			'UserId': this.props.user.id,
			'customerFullName': this.props.user.firstName + ' ' + this.props.user.lastName,
			'email': this.props.user.email
		}
		this.setState({
			'productOrder': productOrder
		})
    }

	handleInputChange(e) {
		this.setState({
			'user': handlers.updateInput(e, this.state.user)
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		// TODO: Configure product details array
		ProductOrderService.create(this.state.productOrder).then((response) => {
			console.log(response);
			this.showAlert('orderSuccess');
			browserHistory.push('/store');
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
			}
		}

		return alerts[selector]();
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/title/Checkout.png" headerAlt="Checkout">
                <div className="row">
					<div className="small-12 columns">
						<Form name="productOrderForm" handleSubmit={this.handleSubmit} submitText="Finalize Order" disable={this.state.pointsAfterPurchase < 0}>
							<div className="row">
								<div className="form-group small-12 medium-4 columns">
									<label className="required">First Name</label>
									<Input type="text" name="fullName" value={this.state.productOrder.fullName} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-4 columns">
									<label className="required">E-mail</label>
									<Input type="text" name="email" value={this.state.productOrder.email} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-4 columns">
									<label className="required">Phone</label>
									<Input type="text" name="phone" value={this.state.productOrder.phone} handleInputChange={this.handleInputChange} validate="domesticPhone" required={true}/>
								</div>
							</div>
							<h3>Shipping Address</h3>
							<div className="row">
								<div className="form-group small-10 columns">
									<label className="required">Street</label>
									<Input type="text" name="shippingStreet" value={this.state.productOrder.shippingStreet} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-2 columns">
									<label>Apt/Suite</label>
									<Input type="text" name="shippingAppartment" value={this.state.productOrder.shippingAppartment} handleInputChange={this.handleInputChange}/>
								</div>
							</div>
							<div className="row">
								<div className="form-group small-12 medium-3 columns">
									<label className="required">City</label>
									<Input type="text" name="firstName" value={this.state.productOrder.firstName} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-3 columns">
									<label className="required">State</label>
									<Input type="text" name="lastName" value={this.state.productOrder.lastName} handleInputChange={this.handleInputChange} required={true}/>
								</div>
								<div className="form-group small-12 medium-3 columns">
									<label className="required">Zipcode</label>
									<Input type="text" name="firstName" value={this.state.productOrder.firstName} handleInputChange={this.handleInputChange} validate="zipcode" required={true}/>
								</div>
								<div className="form-group small-12 medium-3 columns">
									<label className="required">Country</label>
									<Select type="text" name="country" value={this.state.productOrder.country} handleInputChange={this.handleInputChange} required={true}>
										<option value="">--Select--</option>
										<option value="US">United States</option>
									</Select>
								</div>
							</div>
							<div className="row">
								<label>Order Details (Add a note specific to your order)</label>
								<TextArea value={this.state.productOrder.orderDetails} rows="4" handleInputChange={this.handleInputChange} maxLength="255"></TextArea>
							</div>
						</Form>
						{
							this.state.pointsAfterPurchase < 0 &&
							<div className="small-12 columns text-center">
								<h3 className="color-alert">You do not have enough Reward Points for this purchase.</h3>
								<Link to="/store/cart">Return to cart?</Link>
							</div>
						}
						<div className="small-12 columns text-right">
							<h5>Current Reward Points: {this.props.user.rewardPoints}</h5>
							<h5>Order Total: {this.props.cartTotal}</h5>
							<h5>RP After Purchase: {this.state.pointsAfterPurchase}</h5>
						</div>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(CheckoutPage);
