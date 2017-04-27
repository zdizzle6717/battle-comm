'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import {AlertActions} from '../../library/alerts';
import {handlers} from '../../library/utilities';
import {Form, Input} from '../../library/validations';
import ViewWrapper from '../ViewWrapper';
import PlayerService from '../../services/PlayerService';

export default class PasswordResetPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'user': {
				'email': '',
				'password': ''
			},
			'passwordRepeat': ''
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleInputMatch = this.handleInputMatch.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Password Reset";
		if (!this.props.params.resetToken) {
			this.showAlert('invalidToken');
			browserHistory.push('/');
		}
    }

	handleInputMatch(e) {
		this.setState({
			'passwordRepeat': e.target.value
		})
	}

	handleInputChange(e) {
		this.setState({
			'user': handlers.updateInput(e, this.state.user)
		});
	}

	handleSubmit(e) {
		PlayerService.setNewPassword(this.props.params.resetToken, this.state.user).then(() => {
			this.showAlert('passwordUpdated');
			browserHistory.push('/login');
		}).catch((error) => {
			console.log(error);
			this.showAlert('tokenExpired');
			browserHistory.push('/forgot-password');
		});
	}

	showAlert(selector) {
		const alerts = {
			'invalidToken': () => {
				this.props.addAlert({
					'title': 'Invalid Token',
					'message': 'The supplied token is incorrect.  Double check the supplied link from the password reset e-mail.',
					'type': 'error',
					'delay': 5000
				});
			},
			'tokenExpired': () => {
				this.props.addAlert({
					'title': 'Token Expired',
					'message': 'The supplied token has expired.  Submit a forgot password form to receive a new reset link.',
					'type': 'error',
					'delay': 5000
				});
			},
			'passwordUpdated': () => {
				this.props.addAlert({
					'title': 'Password Updated',
					'message': 'Your password was successfully updated. Login to continue.',
					'type': 'success',
					'delay': 5000
				});
			},
		}

		return alerts[selector]();
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Password_Reset.png" headerAlt="Password Reset">
				<div className="row">
					<h3>Enter your e-mail address and click submit to change your password.</h3>
					<Form name="resetPasswordForm" submitText="Submit" handleSubmit={this.handleSubmit}>
						<div className="row">
							<div className="form-group small-12 medium-6 medium-offset-3 columns">
								<label className="required">E-mail</label>
								<Input type="text" name="email" value={this.state.user.email} handleInputChange={this.handleInputChange} validate="email" required={true}/>
							</div>
						</div>
						<div className="row">
							<div className="form-group small-12 medium-6 medium-offset-3 columns">
								<label className="required">New Password</label>
								<Input type="text" name="password" value={this.state.user.password} handleInputChange={this.handleInputChange} validate="password" required={true} inputMatch={this.state.passwordRepeat}/>
							</div>
						</div>
						<div className="row">
							<div className="form-group small-12 medium-6 medium-offset-3 columns">
								<label className="required">Repeat Password</label>
								<Input type="text" name="passwordRepeat" value={this.state.passwordRepeat} handleInputChange={this.handleInputMatch} validate="password" required={true} />
							</div>
						</div>
					</Form>
                </div>
				<div className="row push-top">
					<div className="form-group small-12 columns">
						Return to login page? <Link to="/login">Go to Login</Link>
					</div>
				</div>
				<div className="row">
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
            </ViewWrapper>
        );
    }
}
