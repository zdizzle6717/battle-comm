'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import {AlertActions} from '../../library/alerts';
import {Form, Input, Select, FileUpload} from '../../library/validations'
import {UserActions} from '../../library/authentication';
import Modal from '../../library/Modal';
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
		'getGameSystems': GameSystemActions.getAll,
		'setRedirect': UserActions.setRedirect,
		'showGameList': false
    }, dispatch);
};

class LoginPage extends React.Component {
    constructor() {
        super();

        this.state = {
            'credentials': {}
        }

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Login";
		this.props.getGameSystems();
    }

	handleInputChange(e) {
		let credentials = this.state.credentials;
		credentials[e.target.name] = e.target.value;
		this.setState({
			'credentials': credentials
		})
	}

	handleSubmit(e) {
		// TODO: Fix redirect route or just double check that it works
		this.props.authenticate(this.state.credentials).then(() => {
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
			if (error.message === 'Incorrect password!') {
				this.showAlert('incorrectPassword');
			}
			if (error.message === 'Incorrect username or email!') {
				this.showAlert('incorrectUsername');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
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
								</Form>
								<div className="form-group small-12">
									Don't have an account? <Link key="register" to="/register" activeClassName="active" onClick={this.closeMenu}>Register/Sign Up</Link>
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
								<h4><a onClick={this.toggleModal.bind(this, 'showGameList')}>Supported Game Systems</a></h4>
								<Link to="/register" className="button">Sign Up</Link>
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
