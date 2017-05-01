'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import {AlertActions} from '../../../library/alerts';
import {handlers} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import AdminMenu from '../../pieces/AdminMenu';
import ProductOrderService from '../../../services/ProductOrderService';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class EditProductOrder extends React.Component {
    constructor() {
        super();

		this.state = {
			'productOrder': {},
			'newProductOrder': false,
			'isEditing': false
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.toggleEditing = this.toggleEditing.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Product Order Edit";
		if (this.props.match.params.orderId) {
			ProductOrderService.get(this.props.match.params.orderId).then((productOrder) => {
				this.setState({
					'productOrder': productOrder
				});
			});
		} else {
			this.setState({
				'newProductOrder': true
			})
		}
    }

	handleInputChange(e) {
		e.preventDefault();
		this.setState({
			'productOrder': handlers.updateInput(e, this.state.productOrder)
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		let order = this.state.productOrder;
		let method = this.props.match.params.orderId ? 'update' : 'create';
		ProductOrderService[method]((method === 'update' ? order.id : order), (method === 'update' ? order : null)).then((productOrder) => {
			this.setState({
				'productOrder': productOrder,
				'isEditing': false
			});
			if (this.props.match.params.productOrderId) {
				this.showAlert('productOrderUpdated');
				this.props.history.push('/admin');
			} else {
				this.showAlert('productOrderCreated');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'productOrderCreated': () => {
				this.props.addAlert({
					'title': 'News Order Created',
					'message': `New order successfully created.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'productOrderUpdated': () => {
				this.props.addAlert({
					'title': 'Product Order Updated',
					'message': `Order successfully updated.`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

	toggleEditing() {
		this.setState({
			'isEditing': !this.state.isEditing
		});
	}

    render() {
		let formIsInvalid = getFormErrorCount(this.props.forms, 'productOrderForm') > 0;

        return (
            <ViewWrapper headerImage="/images/Titles/Product_Edit.png" headerAlt="Product Edit">
                <div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
                </div>
				<div className="row">
					<div className="small-12 columns">
						<h2>Edit/Fulfil Product Order</h2>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<fieldset disabled={!this.state.isEditing}>
							<Form name="productOrderForm" submitButton={false}>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Customer Name</label>
										<Input type="text" name="customerFullName" value={this.state.productOrder.customerFullName} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Customer Email</label>
										<Input type="text" name="customerEmail" value={this.state.productOrder.customerEmail} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Phone</label>
										<Input type="text" name="phone" value={this.state.productOrder.phone} handleInputChange={this.handleInputChange} required={true} />
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
										<label>Order Details</label>
										<TextArea name="orderDetails" value={this.state.productOrder.orderDetails || ''} rows="4" handleInputChange={this.handleInputChange}></TextArea>
									</div>
								</div>
							</Form>
						</fieldset>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-title color-black">
								Update Status
							</div>
							<div className="panel-content text-center">
								<Form name="productOrderForm" submitButton={false}>
									<Select type="text" name="status" value={this.state.productOrder.status} handleInputChange={this.handleInputChange} disabled={!this.state.isEditing}>
										<option value="processing">Processing</option>
										<option value="shipped">Shipped</option>
										<option value="complete">Complete</option>
									</Select>
								</Form>
							</div>
						</div>
						<div className="panel push-bottom-2x push-top">
							{
								this.state.isEditing ?
								<div className="panel-content text-center">
									<button className="button black small-12" onClick={this.handleSubmit} disabled={formIsInvalid}>Save Changes</button>
								</div> :
								<div className="panel-content text-center">
									<button className="button black small-12" onClick={this.toggleEditing}>Edit Order?</button>
								</div>
							}
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(EditProductOrder));
