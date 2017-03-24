'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {AlertActions} from '../../../library/alerts';
import {handlers, uploadFiles} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';

export default class EditOrderPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'productOrder': {},
			'newProductOrder': false
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
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

	handleSubmit() {
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
        return (
            <ViewWrapper>
                <div className="small-12 columns">
                    <h1>Product Order Edit</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
				<div className="row">
					<div className="small-12 medium-8 large-9 columns">
						<Form name="productOrderForm" submitText={this.state.newProductOrder ? 'Create Product Order' : 'Update Product Order'} handleSubmit={this.handleSubmit}>
							<div className="row">
								<div className="form-group small-12 medium-4 columns">
									<label className="required">Customer Name</label>
									<Input type="text" name="customerFullName" value={this.state.productOrder.customerFullName} handleInputChange={this.handleInputChange} required={true} />
								</div>
							</div>
						</Form>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						Filters
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
