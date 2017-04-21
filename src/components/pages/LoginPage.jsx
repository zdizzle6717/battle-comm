'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import {AlertActions} from '../../library/alerts';
import {UserActions} from '../../library/authentication';
import {Form, Input, Select, CheckBox, FileUpload} from '../../library/validations';
import {handlers} from '../../library/utilities';
import Modal from '../../library/modal';
import GameSystemActions from '../../actions/GameSystemActions';

// TODO: Verify authentication error catching

const mapStateToProps = (state) => {
	return {
		'gameSystems': state.gameSystems,
		'user': state.user,
		'redirectRoute': state.redirectRoute
	}
}

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'authenticate': UserActions.authenticate,
		'authenticateFromToken': UserActions.authenticateFromToken,
		'getGameSystems': GameSystemActions.getAll,
		'setRedirect': UserActions.setRedirect
    }, dispatch);
};

class LoginPage extends React.Component {
    constructor() {
        super();

        this.state = {
            'credentials': {},
			'showGameList': false
        }

		this.handleCheckBoxChange = this.handleCheckBoxChange.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Login";
		this.props.getGameSystems();
		let storedUser = JSON.parse(localStorage.getItem('bc_user'));
		if (storedUser) {
			let credentials = {
				'username': storedUser.username,
				'password': 'Password#',
				'rememberMe': true
			}
			this.setState({
				'credentials': credentials
			})
		}
    }

	handleCheckBoxChange(e) {
		this.setState({
			'credentials': handlers.updateCheckBox(e, this.state.credentials)
		});
	}

	handleInputChange(e) {
		handlers.updateInput(e, this.state.credentials);
	}

	handleSubmit(e) {
		// TODO: Fix redirect route or just double check that it works
		let storedUser = JSON.parse(localStorage.getItem('bc_user'));
		this.props[storedUser ? 'authenticateFromToken': 'authenticate'](storedUser ? {
			'id_token': storedUser.id_token,
			'rememberMe': true
		} : this.state.credentials).then(() => {
			let homeState = this.props.user.roleConfig.homeState;
			this.showAlert('loginSuccess');
			if (this.props.redirectRoute) {
				let redirectPath = this.props.redirectRoute;
				this.props.setRedirect(false);
				browserHistory.push(redirectPath);
			} else {
				browserHistory.push(homeState);
			}
		}).catch((error) => {
			console.log(error);
			if (error.message === 'Account not activated.') {
				this.showAlert('accountNotActivated');
			}
			if (error.message === 'Incorrect password!') {
				this.showAlert('incorrectPassword');
			}
			if (error.message === 'Incorrect username or email!') {
				this.showAlert('incorrectUsername');
			}
			if (error.message === 'Token has expired.') {
				this.setState({
					'username': '',
					'password': '',
					'rememberMe': true
				})
				this.showAlert('rememberMeTokenExpired');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'accountNotActivated': () => {
				this.props.addAlert({
					'title': 'Account Not Activated',
					'message': 'Your account has not been activated. Please check your e-mail or contact support.',
					'type': 'error',
					'delay': 3000
				});
			},
			'loginSuccess': () => {
				this.props.addAlert({
					'title': 'Login Success',
					'message': 'You have been successfully authenticated.',
					'type': 'success',
					'delay': 3000
				});
			},
			'incorrectPassword': () => {
				this.props.addAlert({
					'title': 'Incorrect Password',
					'message': 'The password you entered is incorrect.',
					'type': 'error',
					'delay': 3000
				});
			},
			'incorrectUsername': () => {
				this.props.addAlert({
					'title': 'Incorrect Email/Username',
					'message': 'No user was found with that email or username.',
					'type': 'error',
					'delay': 3000
				});
			},
			'rememberMeTokenExpired': () => {
				this.props.addAlert({
					'title': 'Token Expired',
					'message': 'Token to remember your login has expired. Please re-enter login credentials.',
					'type': 'error',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

	toggleModal(property, e) {
		if (e) {
			e.preventDefault();
		}
		this.setState({
			[property]: !this.state[property]
		});
	}

    render() {
        return (
			<div className="content-view home-page">
                <div className="content-box-container">
					<div className="box-6">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top">
								<div className="bar"><div className="title small"><img src="images/Titles/Login.png" alt="" /></div></div>
							</div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<Form name="loginForm" submitText="Login" handleSubmit={this.handleSubmit}>
									<div className="row">
										<div className="form-group small-12 columns">
											<label className="required">Username/Email</label>
											<Input type="text" name="username" value={this.state.credentials.username || ''} handleInputChange={this.handleInputChange} validate="username" required={true} />
										</div>
									</div>
									<div className="row">
										<div className="form-group small-12 columns">
											<label className="required">Password</label>
											<Input type="password" name="password" value={this.state.credentials.password || ''} handleInputChange={this.handleInputChange} validate="password" required={true} />
										</div>
									</div>
									<div className="row">
										<div className="form-group small-12 columns">
											<CheckBox name="rememberMe" value={this.state.newsPost.rememberMe} handleInputChange={this.handleCheckBoxChange} label="Remember my login?"/>
										</div>
									</div>
								</Form>
								<div className="form-group small-12 columns text-right push-top">
									<Link key="forgotPassword" to="/forgot-password" activeClassName="active" onClick={this.closeMenu}>Forgot your password? </Link>
								</div>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"><div className="bar"></div></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                    <div className="box-6">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"><div className="bar">
								<div className="bar"><div className="title small"><img src="images/Titles/Register.png" alt="" /></div></div>
                            </div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="small-12 columns">
									<h6>WELCOME TO BATTLE-COMM...the portal to find all levels of friendly, local, table-top gaming. With a long running list of supported table-top gaming systems, Battle-comm is a community of individuals making connections through competition.<br/><br/>  Schedule a tournament, record stats, match up with local players, and compete at the national level.  You will also have the opportunity to earn ranking, achievements, and BC Reward Points to trade-in for related products!</h6>
									<h5 className="text-right push-bottom"><a onClick={this.toggleModal.bind(this, 'showGameList')}>→Supported Game Systems</a></h5>
									<Link to="/register" className="button">Sign Up</Link>
								</div>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"><div className="bar"></div></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
				</div>
				<Modal name="gameListModal" title="Supported Game Systems" modalIsOpen={this.state.showGameList} handleClose={this.toggleModal.bind(this, 'showGameList')} showClose={true} showFooter={false}>
					<ul>
						{
							this.props.gameSystems.map((gameSystem, i) =>
								<li key={i}>{gameSystem.name}</li>
							)
						}
					</ul>
				</Modal>
			</div>
		);
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(LoginPage);
