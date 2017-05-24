'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import {AlertActions} from '../../library/alerts';
import {Form, Input, Select, FileUpload} from '../../library/validations'
import {UserActions} from '../../library/authentication';
import {handlers} from '../../library/utilities';
import ViewWrapper from '../ViewWrapper';

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'createUser': UserActions.create
    }, dispatch);
};

class Register extends React.Component {
    constructor() {
        super();

        this.state = {
            'credentials': {},
			'passwordRepeat': ''
        }

		this.handleInputMatch = this.handleInputMatch.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Register";
    }

	handleInputMatch(e) {
		this.setState({
			'passwordRepeat': e.target.value
		})
	}

	handleInputChange(e) {
		this.setState({
			'credentials': handlers.updateInput(e, this.state.credentials)
		});
	}

	handleSubmit(e) {
		this.props.createUser(this.state.credentials).then((response) => {
			if (this.state.credentials.role === 'member') {
				this.showAlert('registrationSuccess');
				this.props.history.push('/login');
			} else {
				this.showAlert('registrationPending');
				this.props.history.push('/login');
			}
		}).catch((error) => {
			console.log(error);
			if (error.message === 'Username taken') {
				this.showAlert('invalidUsername');
			}
			if (error.message === 'Email taken') {
				this.showAlert('invalidEmail');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'registrationPending': () => {
				this.props.addAlert({
					'title': 'Registration Pending',
					'message': 'Please check your e-mail for further instructions and account activation.',
					'type': 'success',
					'delay': 4000
				});
			},
			'registrationSuccess': () => {
				this.props.addAlert({
					'title': 'Registration Success',
					'message': 'You have successfully registered an account. Please login to continue.',
					'type': 'success',
					'delay': 4000
				});
			},
			'invalidUsername': () => {
				this.props.addAlert({
					'title': 'Invalid Username',
					'message': 'An account with that username is already in use.',
					'type': 'error',
					'delay': 3000
				});
			},
			'invalidEmail': () => {
				this.props.addAlert({
					'title': 'Invalid Email',
					'message': 'An account with that email is already in use.',
					'type': 'error',
					'delay': 3000
				});
			},
		}

		return alerts[selector]();
	}

    render() {
        return (
			<ViewWrapper headerImage="/images/Titles/Register_Large.png" alt="Register">
				<div className="row">
					<div className="small-12 columns">
						<h2>Sign Up to Create a Player Profile</h2>
						<div className="container ice">
							<Form name="registrationForm" submitText="Register" handleSubmit={this.handleSubmit}>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Email</label>
										<Input type="text" name="email" value={this.state.credentials.email || ''} handleInputChange={this.handleInputChange} validate="email" required={true} />
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Username</label>
										<Input type="text" name="username" value={this.state.credentials.username || ''} handleInputChange={this.handleInputChange} validate="username" required={true} />
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label className="required">First Name</label>
										<Input type="text" name="firstName" value={this.state.credentials.firstName || ''} handleInputChange={this.handleInputChange} validate="name" required={true} />
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Last Name</label>
										<Input type="text" name="lastName" value={this.state.credentials.lastName || ''} handleInputChange={this.handleInputChange} validate="name" required={true} />
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Password</label>
										<Input type="password" name="password" value={this.state.credentials.password || ''} handleInputChange={this.handleInputChange} validate="password" required={true} inputMatch={this.state.passwordRepeat}/>
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Repeat Password</label>
										<Input type="password" name="passwordRepeat" value={this.state.passwordRepeat || ''} handleInputChange={this.handleInputMatch} validate="password" required={true} inputMatch={this.state.credentials.password}/>
									</div>
								</div>
								<div className="row">
									<div className="small-12 medium-6 columns right">
										<label className="required">User Role</label>
										<Select name="role" value={this.state.credentials.role} handleInputChange={this.handleInputChange} required={true}>
											<option value="">--Select--</option>
											<option value="member">Member</option>
										</Select>
									</div>
								</div>
							</Form>
							<div className="row">
								<div className="form-group small-12 columns">
									Already have an account? <Link to="/login">Go to Login</Link>
								</div>
							</div>
							<div className="row push-top-2x">
								<div className="small-12 columns text-center">
									<h5 className="required">Password Requirements</h5>
									<ul className="no-bullets">
										<li>Minimum of 8 characters</li>
										<li>At least one lowercase letter</li>
										<li>At least one uppercase letter</li>
										<li>Minimum of 8 characters</li>
										<li>At least one symbol/special character !@#$%^&_-+=,./?</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</ViewWrapper>
		);
    }
}

export default withRouter(connect(null, mapDispatchToProps)(Register));
