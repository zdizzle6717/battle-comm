'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import {AlertActions} from '../../../library/alerts';
import {handlers, uploadFiles} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms
	}
}

class EditProductOrderPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'productOrder': {},
			'newProductOrder': false
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.ebind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Product Order Edit";
		if (this.props.params.orderId) {
			ProductOrderService.get(this.props.params.orderId).then((productOrder) => {
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
		this.setState({
			'productOrder': handlers.updateInput(e, this.state.productOrder)
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		let order = this.state.productOrder;
		let method = this.props.params.productOrderId ? 'update' : 'create';
		ProductOrderService[method]((method === 'update' ? order.id : order), (method === 'update' ? order : null)).then((productOrder) => {
			this.setState({
				'productOrder': productOrder
			});
			if (this.props.params.productOrderId) {
				this.addAlert('productOrderUpdated');
				browserHistory.push('/admin');
			} else {
				this.addAlert('productOrderCreated');
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

    render() {
		let formIsValid = getFormErrorCount(this.props.forms, 'productOrderForm');

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
						<fieldset>
							<Form name="productOrderForm" submitButton={false} handleSubmit={this.handleSubmit}>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Customer Name</label>
										<Input type="text" name="customerFullName" value={this.state.productOrder.customerFullName} handleInputChange={this.handleInputChange} required={true} />
									</div>
								</div>
							</Form>
						</fieldset>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-content text-center">
								<button className="button black small-12" onClick={this.handleSubmit} disabled={!formIsValid}>Update Product Order</button>
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, null)(EditProductOrderPage);
