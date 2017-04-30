'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {UserActions} from '../../library/authentication';
import {AlertActions} from '../../library/alerts';
import env from '../../../envVariables';
import {handlers} from '../../library/utilities';
import {Form, Input, TextArea, Select, getFormErrorCount} from '../../library/validations';
import PaymentService from '../../services/PaymentService';
import PlayerService from '../../services/PlayerService';

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'modifyUser': UserActions.modify,
	}, dispatch);
}

// TODO: add proptypes config
// TODO: Add security, lock down price config so user can't alter values in developer tools

class RewardPointPurchasePage extends React.Component {
    constructor() {
        super();

		this.state = {
			'formIsActive': true,
            'stripeLoading': true,
			'rpPurchaseForm': {
				'email': '',
				'rewardPoints': ''
			},
			'priceConfig': [
				{
					'display': '1000RP - $9.99',
					'value': 999,
					'rp': 1000
				},
				{
					'display': '5000RP - $19.99',
					'value': 1999,
					'rp': 5000
				},
			]
        };

		this.loadStripe = this.loadStripe.bind(this);
		this.openStripeModal = this.openStripeModal.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
    }

	componentWillMount() {}

	componentDidMount() {
		document.title = "Battle-Comm | Purchase RP";
		this.setState({
			'rpPurchaseForm': {
				'email': this.props.user.email
			}
		})

        this.loadStripe(() => {
			// Handler for acknowledging card token response
			let handleSubmit = (token) => {
				this.setState({
					'loading': true
				});
				let amount = parseInt(this.state.rpPurchaseForm.rewardPoints, 10);
				PaymentService.oneTimeCharge({
					'token': JSON.stringify(token),
					'details': {
						'amount': amount,
						'description': 'Reward Point Purchase',
						'email': this.state.rpPurchaseForm.email
					}
				}).then((response) => {
					if (response.status === 'succeeded') {
						let selection = this.state.priceConfig.find((config) => {
							return config.value === amount;
						});
						PlayerService.updateRP(this.props.user.id, {
							'direction': 'increment',
							'rewardPoints': selection.rp
						}).then((user) => {
							this.props.modifyUser({
								'rewardPoints': user.rewardPoints
							});
							this.showAlert('orderSuccess');
							this.setState({
								'rpPurchaseForm': {
									'rewardPoints': ''
								},
								'formIsActive': false
							}, () => {
								setTimeout(() => {
									this.setState({
										'formIsActive': true
									});
								});
							});
						});
					} else {
						this.showAlert('orderFailed');
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
		this.setState({
			'rpPurchaseForm': handlers.updateInput(e, this.state.rpPurchaseForm)
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
		let amount = parseInt(this.state.rpPurchaseForm.rewardPoints, 10);
        this.stripehandler.open({
			'name': 'Battle-Comm',
            'description': 'Reward Point Purchase',
			'amount': amount,
			'email': this.state.rpPurchaseForm.email,
            'panelLabel': 'Complete Order',
			'zipCode': true
        });
        e.preventDefault();
    }

	showAlert(selector) {
		const alerts = {
			'orderSuccess': () => {
				let selection = this.state.priceConfig.find((config) => {
					return config.value === parseInt(this.state.rpPurchaseForm.rewardPoints, 10);
				});
				this.props.addAlert({
					'title': 'Order Success',
					'message': `Your RP pool has been updated and ${selection.rp}RP were added to your account.`,
					'type': 'success',
					'delay': 4000
				});
			},
			'userUpdated': () => {
				this.props.addAlert({
					'title': 'Payment Declined',
					'message': 'An error occured, and your card was NOT charged. Please try again or contact a site administrator for additional support.',
					'type': 'error',
					'delay': 4000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
		let formIsInvalid = getFormErrorCount(this.props.forms, 'rpPurchaseForm') > 0;

        return (
			<div className="small-12 columns">
				<h2>Purchase Reward Points</h2>
				<div className="row">
					<div className="small-12 columns text-center">
						<h6>Add reward points to your store or venue pool for player distribution at tournaments or other qualifying events.</h6>
					</div>
				</div>
				{
					this.state.formIsActive &&
					<Form name="rpPurchaseForm" submitButton={false}>
						<div className="row">
							<div className="form-group small-12 medium-4 medium-offset-2 columns">
								<label className="required">E-mail</label>
								<Input type="text" name="email" value={this.state.rpPurchaseForm.email} handleInputChange={this.handleInputChange} validate="email" required={true} />
							</div>
							<div className="form-group small-12 medium-4 columns">
								<label>Reward Points</label>
								<Select name="rewardPoints" value={this.state.rpPurchaseForm.rewardPoints} handleInputChange={this.handleInputChange} required={true}>
									<option value="">--Select--</option>
									{
										this.state.priceConfig.map((option, i) =>
											<option key={i} value={option.value}>{option.display}</option>
										)
									}
								</Select>
							</div>
						</div>
					</Form>
				}
                <div className="row">
					<div className="small-12 columns text-center">
						<div>
			                {(this.state.stripeLoading)
			                    ? <p>loading..</p>
			                    : <button className="button secondary" onClick={this.openStripeModal} disabled={formIsInvalid}>Checkout</button>
			                }
			            </div>
					</div>
                </div>
            </div>
        );
    }

	componentWillUnmount() {
        if(this.stripehandler) {
            this.stripehandler.close();
        }
    }
}

export default connect(null, mapDispatchToProps)(RewardPointPurchasePage);
