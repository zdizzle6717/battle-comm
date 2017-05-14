'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import {handlers} from '../../../library/utilities';
import {Form, Input} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import PlayerService from '../../../services/PlayerService';

const mapStateToProps = (state) => {
	return {
		'user': state.user
	};
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class PlayerChangePassword extends React.Component {
    constructor() {
        super();

		this.state = {
			'credentials': {},
			'passwordRepeat': ''
		};

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleInputMatch = this.handleInputMatch.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Password Change";
    }

	handleInputMatch(e) {
		this.setState({
			'passwordRepeat': e.target.value
		})
	}

	handleInputChange(e) {
		this.setState({
			'user': handlers.updateInput(e, this.state.credentials)
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		PlayerService.changePassword(this.props.user.id, {
			'username': this.props.user.username,
			'password': this.state.credentials.password,
			'newPassword': this.state.credentials.newPassword
		}).then(() => {
			this.showAlert('passwordUpdated');
		});
	}

	showAlert(selector) {
		const alerts = {
			'passwordUpdated': () => {
				this.props.addAlert({
					'title': 'Password Updated',
					'message': 'Your password was successfully updated. Login with the new password to continue.',
					'type': 'success',
					'delay': 4000
				});
			},
		}

		return alerts[selector]();
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Change_Password.png" headerAlt="Change Password">
				<div className="row">
					<div className="small-12 columns">
						<h3 className="text-center">Enter your e-mail address and click submit to change your password.</h3>
						<Form name="changePasswordForm" submitText="Submit" handleSubmit={this.handleSubmit}>
							<div className="row">
								<div className="form-group small-12 medium-4 medium-offset-4 columns">
									<label className="required">Current Password</label>
									<Input type="password" name="password" value={this.state.credentials.password} handleInputChange={this.handleInputChange} validate="password" required={true} inputMatch={this.state.passwordRepeat}/>
								</div>
							</div>
							<div className="row">
								<div className="form-group small-12 medium-4 medium-offset-4 columns">
									<label className="required">New Password</label>
									<Input type="password" name="newPassword" value={this.state.credentials.newPassword} handleInputChange={this.handleInputChange} validate="password" required={true} inputMatch={this.state.passwordRepeat}/>
								</div>
							</div>
							<div className="row">
								<div className="form-group small-12 medium-4 medium-offset-4 columns">
									<label className="required">Repeat New Password</label>
									<Input type="password" name="passwordRepeat" value={this.state.passwordRepeat} handleInputChange={this.handleInputMatch} inputMatch={this.state.credentials.newPassword} validate="password" required={true} />
								</div>
							</div>
						</Form>
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
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(PlayerChangePassword));
