'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import {formatJSONDate} from '../../../library/utilities';
import {checkAuthorization, UserActions} from '../../../library/authentication';
import {getFormErrorCount, Form, Input, Select, TextArea, CheckBox, RadioGroup, FileUpload} from '../../../library/validations';
import {handlers} from '../../../library/utilities';
import ViewWrapper from '../../ViewWrapper';
import PaymentService from '../../../services/PaymentService';
import PlayerService from '../../../services/PlayerService';
import roleConfig from '../../../../roleConfig';
import env from '../../../../envVariables';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms,
		'user': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'modifyUser': UserActions.modify
	}, dispatch);
}

class PlayerAccountEdit extends React.Component {
    constructor() {
        super();

		this.state = {
			'currentUser': {
			},
			'customerDetails': {},
			'isEditing': {
				'contacts': false,
				'shipping': false
			},
			'userIsSubscriber': false
		};

		this.cancelEdit = this.cancelEdit.bind(this);
		this.getCurrentPlayer = this.getCurrentPlayer.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.savePlayer = this.savePlayer.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Account";
		let userIsSubscriber = checkAuthorization(['subscriber'], this.props.user, roleConfig);
		if (!this.props.user.id) {
			this.props.history.push('/');
		} else {
			this.getCurrentPlayer();
			// TODO: This should actually just check for an existing customerId
			if (userIsSubscriber && !this.props.user.systemAdmin) {
				PaymentService.getCustomer(this.props.user.id).then((customer) => {
					let subscription = customer.subscriptions.data.find(subscription => subscription.status === 'active');
					this.setState({
						'customerDetails': customer,
						'subscription': subscription,
						'userIsSubscriber': true
					});
				});
			}
		}
    }

	cancelEdit() {
		let isEditing = this.state.isEditing;
		for (let prop in isEditing) {
			isEditing[prop] = false;
		}
		this.setState({
			'isEditing': isEditing
		});
		this.getCurrentPlayer();
	}

	getCurrentPlayer() {
		PlayerService.getById(this.props.user.id).then((currentUser) => {
			this.setState({
				'currentUser': currentUser
			})
		});
	}

	handleInputChange(e) {
		this.setState({
			'currentUser': handlers.updateInput(e, this.state.currentUser)
		});
	}

	handleSubmit(identifier) {
		return;
	}

	savePlayer() {
		PlayerService.update(this.state.currentUser.id, this.state.currentUser).then((updatedUser) => {
			let isEditing = this.state.isEditing;
			for (let prop in isEditing) {
				isEditing[prop] = false;
			}
			this.setState({
				'isEditing': isEditing
			});
			this.props.modifyUser(updatedUser);
			this.getCurrentPlayer();
			this.showAlert('playerUpdated');
		});
	}

	toggleEdit(identifier) {
		let isEditing = this.state.isEditing;
		for (let prop in isEditing) {
			isEditing[prop] = false;
		}
		isEditing[identifier] = true;
		this.setState({
			'isEditing': isEditing
		});
		this.getCurrentPlayer();
	}

	showAlert(selector) {
		const alerts = {
			'playerUpdated': () => {
				this.props.addAlert({
					'title': 'Profile Updated',
					'message': `Your profile was successfully updated`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
		let currentUser = this.state.currentUser;
		let isEditing = this.state.isEditing;
		let contactFormIsValid = getFormErrorCount(this.props.forms, 'contactForm') < 1;
		let shippingFormIsValid = getFormErrorCount(this.props.forms, 'shippingForm') < 1;

        return (
            <ViewWrapper headerImage="/images/Titles/Account_Details.png" headerAlt="Account Details">
				<div className="row">
					<div className="small-12 medium-6 columns">
						<h2 className="text-center">Contact Information</h2>
						<div className={isEditing.contact ? 'editable active' : 'editable'}>
							{
								isEditing.contact ?
								<Form name="contactForm" handleSubmit={this.handleSubmit.bind(this, 'contact')} submitButton={false}>
									<div className="form-group inline">
										<label className="title bold">First Name:</label>
										<Input name="firstName" type="text" id="firstName" value={currentUser.firstName} handleInputChange={this.handleInputChange}/>
									</div>
									<div className="form-group inline">
										<label className="title bold">Last Name:</label>
										<Input name="lastName" type="text" id="lastName" value={currentUser.lastName} handleInputChange={this.handleInputChange}/>
									</div>
									<div className="form-group inline">
										<label className="title bold">E-mail:</label>
										<Input name="email" type="email" id="email" value={currentUser.email} handleInputChange={this.handleInputChange} disabled={true}/>
									</div>
									<div className="form-group inline">
										<label className="title bold">Phone:</label>
										<Input name="mainPhone" type="text" id="mainPhone" value={currentUser.mainPhone} handleInputChange={this.handleInputChange} validate="domesticPhone" />
									</div>
								</Form> :
								<div className="user-contact">
									<ul className="no-bullets">
										<li>First Name: {currentUser.firstName}</li>
										<li>Last Name: {currentUser.lastName}</li>
										<li>E-mail: {currentUser.email}</li>
										<li>Phone: {currentUser.mainPhone}</li>
									</ul>
								</div>
							}
							{
								isEditing.contact ?
								<div className="action-group">
									<button className="cancel" onClick={this.cancelEdit}>
										<span className="fa fa-times"></span>
									</button>
									<button className="save" onClick={this.savePlayer} disabled={!contactFormIsValid}>
										<span className="fa fa-check"></span>
									</button>
								</div> :
								<div className="action-group">
									<button className="edit" onClick={this.toggleEdit.bind(this, 'contact')}>
										<span className="fa fa-edit"></span>
									</button>
								</div>
							}
						</div>
					</div>
					<div className="small-12 medium-6 columns">
						<h2 className="text-center">Shipping Address</h2>
						<div className={isEditing.shipping ? 'editable active' : 'editable'}>
							{
								isEditing.shipping ?
								<Form name="shippingForm" handleSubmit={this.handleSubmit.bind(this, 'shipping')} submitButton={false}>
									<div className="form-group inline">
										<label className="title bold">Address:</label>
										<Input name="streetAddress" type="text" id="streetAddress" value={currentUser.streetAddress} maxlength="50" handleInputChange={this.handleInputChange}/>
									</div>
									<div className="form-group inline">
										<label className="title bold">Apt/Suite:</label>
										<Input name="aptSuite" type="text" id="aptSuite" value={currentUser.aptSuite} maxlength="10" handleInputChange={this.handleInputChange}/>
									</div>
									<div className="form-group inline">
										<label className="title bold">City:</label>
										<Input name="city" type="text" id="city" value={currentUser.city} maxlength="50" handleInputChange={this.handleInputChange}/>
									</div>
									<div className="form-group inline">
										<label className="title bold">State:</label>
										<Input name="state" type="text" id="state" value={currentUser.state} maxlength="50" handleInputChange={this.handleInputChange}/>
									</div>
									<div className="form-group inline">
										<label className="title bold">Zip:</label>
										<Input name="zip" type="text" id="zip" value={currentUser.zip} minlength={5} maxlength={12} handleInputChange={this.handleInputChange}/>
									</div>
								</Form> :
								<div className="user-shipping">
									<ul className="no-bullets">
										<li>Address: {currentUser.streetAddress}</li>
										<li>Apt/Suite: {currentUser.aptSuite}</li>
										<li>City: {currentUser.city}</li>
										<li>State: {currentUser.state}</li>
										<li>Zip: {currentUser.zip}</li>
									</ul>
								</div>
							}
							{
								isEditing.shipping ?
								<div className="action-group">
									<button className="cancel" onClick={this.cancelEdit}>
										<span className="fa fa-times"></span>
									</button>
									<button className="save" onClick={this.savePlayer} disabled={!shippingFormIsValid}>
										<span className="fa fa-check"></span>
									</button>
								</div> :
								<div className="action-group">
									<button className="edit" onClick={this.toggleEdit.bind(this, 'shipping')}>
										<span className="fa fa-edit"></span>
									</button>
								</div>
							}
						</div>
					</div>
				</div>
				<div className="row push-top-2x text-center">
					<div className="small-12 columns">
						<h2>Subscription Details</h2>
						{
							this.state.userIsSubscriber ?
							<div>
								<div className="small-12 medium-4 columns">
									<h5>Customer E-mail</h5>
									<h5><strong>{this.state.customerDetails.email}</strong></h5>
									<hr/>
								</div>
								<div className="small-12 medium-4 columns">
									<h5>Subscription Type</h5>
									<h5><strong>{this.state.subscription.plan.name}</strong></h5>
									<hr/>
								</div>
								<div className="small-12 medium-4 columns">
									<h5>End Date</h5>
									<h5><strong>{formatJSONDate(this.state.subscription.current_period_end)}</strong></h5>
									<hr/>
								</div>
							</div> :
							<h4>Battle-Comm subscribers earn extra rewards, free shipping on all purchases, and first-hand access to extended features. <Link to="/subscribe"><strong>Become a BC Subscriber</strong></Link></h4>
						}
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(PlayerAccountEdit));
