'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import {AlertActions} from '../../library/alerts';
import {Form, Input} from '../../library/validations';
import ViewWrapper from '../ViewWrapper';
import PlayerService from '../../services/PlayerService';

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class ForgotPassword extends React.Component {
    constructor() {
        super();

		this.state = {
			'email': ''
		}

		this.handleEmailInputChange = this.handleEmailInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Forgot your password?";
    }

	handleEmailInputChange(e) {
		e.preventDefault();
		this.setState({
			'email': e.target.value
		})
	}

	handleSubmit(e) {
		PlayerService.resetPassword({
			'email': this.state.email
		}).then((user) => {
			this.showAlert('emailSent');
			this.props.history.push('/login');
		}).catch((response) => {
			console.log(response.message);
			if (response.message === 'User not found.') {
				this.showAlert('userNotFound');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'emailSent': () => {
				this.props.addAlert({
					'title': 'E-mail Sent',
					'message': 'Check your e-mail for a link and instructions to reset your password.',
					'type': 'success',
					'delay': 5000
				});
			},
			'userNotFound': () => {
				this.props.addAlert({
					'title': 'User Not Found',
					'message': 'No user was found with the supplied e-mail. Please try another e-mail address.',
					'type': 'error',
					'delay': 5000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Forgot_Password.png" headerAlt="Forgot Password">
                <div className="row">
					<div className="small-12 columns">
						<h3>Enter your e-mail address and click submit to change your password.</h3>
						<Form name="forgotPasswordForm" submitText="Submit" handleSubmit={this.handleSubmit}>
							<div className="row">
								<div className="form-group small-12 medium-6 medium-offset-3 columns">
									<label className="required">Email</label>
									<Input type="text" name="email" value={this.state.email} handleInputChange={this.handleEmailInputChange} validate="email" required={true} />
								</div>
							</div>
						</Form>
					</div>
                </div>
				<div className="row push-top">
					<div className="form-group small-12 columns">
						Return to login page? <Link to="/login">Go to Login</Link>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(null, mapDispatchToProps)(ForgotPassword));
