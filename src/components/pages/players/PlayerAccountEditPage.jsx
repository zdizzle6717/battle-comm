'use strict';

import React from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {getFormErrorCount, Form, Input, Select, TextArea, CheckBox, RadioGroup, FileUpload} from '../../../library/validations';
import {handlers} from '../../../library/utilities';
import ViewWrapper from '../../ViewWrapper';
import PlayerService from '../../../services/PlayerService';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms
	}
}

class PlayerAccountEditPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'currentUser': {
			},
			'isEditing': {
				'contacts': false,
				'shipping': false
			}
		};

		this.cancelEdit = this.cancelEdit.bind(this);
		this.getCurrentPlayer = this.getCurrentPlayer.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.savePlayer = this.savePlayer.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Account";
		if (!this.props.currentUser.id) {
			browserHistory.push('/');
		} else {
			this.getCurrentPlayer();
		}
    }

	cancelEdit() {
		let isEditing = this.state.isEditing;
		for (prop in isEditing) {
			isEditing[prop] = false;
		}
		this.setState({
			'isEditing': isEditing
		});
		this.getCurrentPlayer();
	}

	getCurrentPlayer() {
		PlayerService.getById(this.props.currentUser.id).then((currentUser) => {
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
		PlayerService.update(this.state.currentUser).then((updatedUser) => {

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

    render() {
		let currentUser = this.state.currentUser;
		let contactFormIsValid = getFormErrorCount(this.props.forms, 'contactForm') < 1;
		let shippingFormIsValid = getFormErrorCount(this.props.forms, 'shippingForm') < 1;

        return (
            <ViewWrapper>
				<div className="row">
					<div className="small-12 medium-6 columns">
						<h2 class="text-center">Contact Information</h2>
						<div class="editable">
							{
								this.state.isEditing.contact ?
								<Form name="contactForm" handleSubmit={this.handleSubmit.bind(this, 'contact')}>
									<div class="form-group inline">
										<label class="title bold">First Name:</label>
										<Input name="firstName" type="text" id="firstName" value={currentUser.firstName} handleInputChange={this.handleInputChange}/>
									</div>
									<div class="form-group inline">
										<label class="title bold">Last Name:</label>
										<Input name="lastName" type="text" id="lastName" value={currentUser.lastName} handleInputChange={this.handleInputChange}/>
									</div>
									<div class="form-group inline">
										<label class="title bold">E-mail:</label>
										<Input name="email" type="email" id="email" value={currentUser.email} handleInputChange={this.handleInputChange} disabled={true}/>
									</div>
									<div class="form-group inline">
										<label class="title bold">Phone:</label>
										<Input name="mainPhone" type="text" id="mainPhone" value={currentUser.mainPhone} handleInputChange={this.handleInputChange} validate={'foreignPhone'} />
									</div>
								</Form> :
								<div class="user-contact">
									<ul>
										<li>First Name: {currentUser.firstName}</li>
										<li>Last Name: {currentUser.lastName}</li>
										<li>E-mail: {currentUser.email}</li>
										<li>Phone: {currentUser.mainPhone}</li>
									</ul>
								</div>
							}
							{
								this.state.isEditing.contact ?
								<div className="action-group">
									<div className="text-right">
										<button className="cancel" onClick={this.cancelEdit}>
											<span className="fa fa-check-square-o"></span>
										</button>
									</div>
									<div className="text-right">
										<button className="save" onClick={this.savePlayer} disabled={!contactFormIsValid}>
											<span className="fa fa-check-square-o"></span>
										</button>
									</div>
								</div> :
								<div className="text-right">
									<button className="edit" onClick={this.toggleEdit.bind(this, 'contact')}>
										<span className="fa fa-edit"></span>
									</button>
								</div>
							}
						</div>
					</div>
					<div className="small-12 medium-6 columns">
						<h2 class="text-center">Shipping Address</h2>
						<div class="editable">
							{
								this.state.isEditing.shipping ?
								<Form name="shippingForm" handleSubmit={this.handleSubmit.bind(this, 'shipping')}>
									<div class="form-group inline">
										<label class="title bold">Address:</label>
										<Input name="streetAddress" type="text" id="streetAddress" value={currentUser.streetAddress} maxlength="50" handleInputChange={this.handleInputChange}/>
									</div>
									<div class="form-group inline">
										<label class="title bold">Apt/Suite:</label>
										<Input name="aptSuite" type="text" id="aptSuite" value={currentUser.aptSuite} maxlength="10" handleInputChange={this.handleInputChange}/>
									</div>
									<div class="form-group inline">
										<label class="title bold">City:</label>
										<Input name="city" type="text" id="city" value={currentUser.city} maxlength="50" handleInputChange={this.handleInputChange}/>
									</div>
									<div class="form-group inline">
										<label class="title bold">State:</label>
										<Input name="state" type="text" id="state" value={currentUser.state} maxlength="50" handleInputChange={this.handleInputChange}/>
									</div>
									<div class="form-group inline">
										<label class="title bold">Zip:</label>
										<Input name="zip" type="text" id="zip" value={currentUser.zip} minlength="5" maxlength="12" handleInputChange={this.handleInputChange}/>
									</div>
								</Form> :
								<div class="user-shipping">
									<ul>
										<li>Address: {currentUser.streetAddress}</li>
										<li>Apt/Suite: {currentUser.aptSuite}</li>
										<li>City: {currentUser.city}</li>
										<li>State: {currentUser.state}</li>
										<li>Zip: {currentUser.zip}</li>
									</ul>
								</div>
							}
							{
								this.state.isEditing.shipping ?
								<div className="action-group">
									<div className="text-right">
										<button className="cancel" onClick={this.cancelEdit}>
											<span className="fa fa-check-square-o"></span>
										</button>
									</div>
									<div className="text-right">
										<button className="save" onClick={this.savePlayer} disabled={!shippingFormIsValid}>
											<span className="fa fa-check-square-o"></span>
										</button>
									</div>
								</div> :
								<div className="text-right">
									<button className="edit" onClick={this.toggleEdit.bind(this, 'shipping')}>
										<span className="fa fa-edit"></span>
									</button>
								</div>
							}
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, null)(PlayerAccountEditPage);
