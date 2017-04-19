'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import {UserService} from '../../../library/authentication';
import {AlertActions} from '../../../library/alerts';
import {handlers} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms
	}
}

class EditUserPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'user': {},
			'newUser': false
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | User Edit";
		if (this.props.params.orderId) {
			UserService.get(this.props.params.orderId).then((user) => {
				this.setState({
					'user': user
				});
			});
		} else {
			this.setState({
				'newUser': true
			})
		}
    }

	handleInputChange(e) {
		this.setState({
			'user': handlers.updateInput(e, this.state.user)
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		let order = this.state.user;
		let method = this.props.params.userId ? 'update' : 'create';
		UserService[method]((method === 'update' ? order.id : order), (method === 'update' ? order : null)).then((user) => {
			this.setState({
				'user': user
			});
			if (this.props.params.userId) {
				this.addAlert('userUpdated');
				browserHistory.push('/admin');
			} else {
				this.addAlert('userCreated');
			}
		});
	}


	// TODO: Add server error alert
	// Reward Point Email Failed.
	// Account Activation Email Failed.
	showAlert(selector) {
		const alerts = {
			'userCreated': () => {
				this.props.addAlert({
					'title': 'User Created',
					'message': `New user successfully created.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'userUpdated': () => {
				this.props.addAlert({
					'title': 'User Updated',
					'message': `Order successfully updated.`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
		let formIsValid = getFormErrorCount(this.props.forms, 'userForm');

        return (
            <ViewWrapper headerImage="/images/Titles/Player_Edit.png" headerAlt="Player Edit">
                <div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
                </div>
				<div className="row">
					<div className="small-12 columns">
						<h2>Edit user {this.state.user.username}</h2>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<fieldset>
							<Form name="userForm" submitButton={false} handleSubmit={this.handleSubmit}>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Title</label>
										<Input type="text" name="id" value={this.state.user.id} handleInputChange={this.handleInputChange} required={true} disabled={true}/>
									</div>
								</div>
							</Form>
						</fieldset>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-content text-center">
								<button onClick={this.handleSubmit} disabled={!formIsValid}>Update User</button>
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, null)(EditUserPage);
