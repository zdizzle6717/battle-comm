'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import env from '../../../envVariables';
import {AlertActions} from '../../library/alerts';
import {UserActions} from '../../library/authentication';
import {Form, Input, TextArea, Select, FileUpload, getFormErrorCount} from '../../library/validations';
import {handlers} from '../../library/utilities';
import ViewWrapper from '../ViewWrapper';
import PaymentService from '../../services/PaymentService';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms,
		'user': state.user
	}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'logout': UserActions.logout
    }, dispatch);
};

class Subscribe extends React.Component {
    constructor() {
        super();

		this.state = {
			'plans': [],
			'selectedPlan': {},
			'stripeLoading': true,
			'subscriptionInfo': {

			},
			'passwordRepeat': ''
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handlePlanChange = this.handlePlanChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.loadStripe = this.loadStripe.bind(this);
		this.openStripeModal = this.openStripeModal.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Subscribe";
		let {user} = this.props;
		if (this.props.user.roleConfig.name !== 'member') {
			this.showAlert('membersOnly');
			this.props.history.push('/players/dashboard');
		}
		this.setState({
			'subscriptionInfo': {
				'firstName': user.firstName,
				'lastName': user.lastName,
				'username': user.username,
				'email': user.email
			}
		})
		PaymentService.getSubscriptionPlans().then((plans) => {
			this.setState({
				'plans': plans.data
			})
		});

		this.loadStripe(() => {
			// Handler for acknowledging card token response
			let handleSubmit = (token) => {
				PaymentService.createSubscription({
					'UserId': this.props.user.id,
					'token': JSON.stringify(token),
					'plan': JSON.stringify(this.state.selectedPlan),
					'email': this.props.user.email,
					'description': 'Battle-Comm Subscription'
				}).then((response) => {
					if (response.charge.status === 'succeeded') {
						// TODO: If package includes rewardPoints, add to account
						this.props.modifyUser({
							'rewardPoints': response.user.rewardPoints
						});
						this.showAlert('subscriptionSuccess');
						setTimeout(() => {
							this.props.logout();
						})
						this.props.history.push('/login');
					} else {
						this.showAlert('orderFailed');
					}
				}).catch((error) => {
					if (error.message === `Don't fuck with the machine!`) {
						this.showAlert('fuckOffHackers');
					}
				})
			};

            this.stripehandler = window.StripeCheckout.configure({
                'key': env.stripe.testPublishable,
                'image': '/images/branding/128-logo.jpg',
                'locale': 'auto',
                'token': handleSubmit
            });

            this.setState({
                'stripeLoading': false
            });
        });
    }

	handleInputChange(e) {
		e.preventDefault();
		this.setState({
			'subscriptionInfo': handlers.updateInput(e, this.state.subscriptionInfo)
		});
	}

	handlePlanChange(e) {
		e.preventDefault();
		let plan = this.state.plans.find((plan) => {
			return plan.id === e.target.value;
		});
		this.setState({
			'subscriptionInfo': handlers.updateInput(e, this.state.subscriptionInfo),
			'selectedPlan': plan
		});

	}

	handleSubmit(e) {
		PaymentService.createSubscription({
			'UserId': this.props.user.id,
			'email': this.props.user.email,
			'plan': JSON.stringify(this.state.selectedPlan),
			'description': 'Battle-Comm Subscription'
		}).then((response) => {
			this.showAlert('subscriptionSuccess');
			setTimeout(() => {
				this.props.logout();
			})
			this.props.history.push('/login');
		});
	}

	loadStripe(onload) {
        if(!window.StripeCheckout) {
            const script = document.createElement('script');
            script.onload = () => {
                onload();
            };
            script.src = 'https://checkout.stripe.com/checkout.js';
            document.head.appendChild(script);
        } else {
            onload();
        }
    }

	openStripeModal(e) {
        this.stripehandler.open({
			'name': 'Battle-Comm',
            'description': 'Battle-Comm Subscription',
			'amount': 0,
			'email': this.state.subscriptionInfo.email,
            'panelLabel': 'Complete Subscription',
			'zipCode': true
        });
        e.preventDefault();
    }

	showAlert(selector) {
		const alerts = {
			'membersOnly': () => {
				this.props.addAlert({
					'title': 'Member\'s Only',
					'message': 'Only members can subscribe. Either you are already subscribed or you do not have access to this feature.',
					'type': 'info',
					'delay': 4000
				});
			},
			'subscriptionSuccess': () => {
				this.props.addAlert({
					'title': 'Subscription Submitted',
					'message': 'You subscription has been submitted.  Please check your e-mail to complete your account activation.',
					'type': 'success',
					'delay': 4000
				});
			},
			'orderSuccess': () => {
				this.props.addAlert({
					'title': 'Order Success',
					'message': `Your RP pool has been updated and RP were added to your account.`,
					'type': 'success',
					'delay': 4000
				});
			},
			'orderFailed': () => {
				this.props.addAlert({
					'title': 'Payment Declined',
					'message': 'An error occured, and your card was NOT charged. Please try again or contact a site administrator for additional support.',
					'type': 'error',
					'delay': 4000
				});
			},
			'fuckOffHackers': () => {
				this.props.addAlert({
					'title': 'Fuck Off!',
					'message': `Hey hackers, don't fuck with the machine!`,
					'type': 'error',
					'delay': 10000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
		let formIsInvalid = getFormErrorCount(this.props.forms, 'subscribeForm') > 0;

        return (
            <ViewWrapper headerImage="/images/Titles/Subscribe.png" alt="Subscribe">
                <div className="row subscribe">
                    <div className="plaque">
						<img src="/images/branding/plaque-logo.png" alt="Battle-Comm Plaque"/>
                    </div>
					<div className="subscribe-form">
						<div className="container ice">
							<h2 className="text-center">Player Details</h2>
							<Form name="subscribeForm" submitButton={false}>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label className="required">E-mail</label>
										<Input type="text" name="email" value={this.state.subscriptionInfo.email} handleInputChange={this.handleInputChange} validate="email" required={true} disabled={true}/>
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Username</label>
										<Input type="text" name="username" value={this.state.subscriptionInfo.username} handleInputChange={this.handleInputChange} required={true} disabled={true}/>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label className="required">First Name</label>
										<Input type="text" name="firstName" value={this.state.subscriptionInfo.firstName} handleInputChange={this.handleInputChange} required={true} disabled={true}/>
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Last Name</label>
										<Input type="text" name="lastName" value={this.state.subscriptionInfo.lastName} handleInputChange={this.handleInputChange} required={true} disabled={true}/>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 columns">
										<label className="required">Subscriber Package</label>
										<Select name="planId" value={this.state.subscriptionInfo.planId} handleInputChange={this.handlePlanChange} required={true}>
											<option value="">--Select--</option>
											{
												this.state.plans.map((plan, i) =>
													<option key={plan.id} value={plan.id}>{plan.name}</option>
												)
											}
										</Select>
									</div>
								</div>
							</Form>
							<div className="row">
								<div className="small-12 columns text-center">
									{
										this.props.user.customerId ?
										<button className="button secondary" onClick={this.handleSubmit} disabled={formIsInvalid}>Checkout</button>
										:
										<div>
							                {
												this.state.stripeLoading ?
												<p>loading..</p> :
												<button className="button secondary" onClick={this.openStripeModal} disabled={formIsInvalid}>Checkout</button>
							                }
							            </div>
									}

								</div>
			                </div>
						</div>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Subscribe);
