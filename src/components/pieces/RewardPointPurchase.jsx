'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {UserActions} from '../../library/authentication';
import {AlertActions} from '../../library/alerts';
import env from '../../../envVariables';
import {handlers} from '../../library/utilities';
import {Form, Input, TextArea, Select, getFormErrorCount} from '../../library/validations';
import PaymentService from '../../services/PaymentService';
import pointPriceConfig from '../../../pointPriceConfig';

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'modifyUser': UserActions.modify,
	}, dispatch);
}

// TODO: add proptypes config
// TODO: Add security, lock down price config so user can't alter values in developer tools

class RewardPointPurchase extends React.Component {
    constructor() {
        super();

		this.state = {
			'formIsActive': true,
            'stripeLoading': true,
			'rpPurchaseForm': {
				'email': '',
				'rewardPoints': ''
			}
        };

		this.loadStripe = this.loadStripe.bind(this);
		this.openStripeModal = this.openStripeModal.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.showAlert = this.showAlert.bind(this);
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
				PaymentService.purchaseRP(this.props.user.id, {
					'token': JSON.stringify(token),
					'details': {
						'email': this.state.rpPurchaseForm.email,
						'description': 'Reward Point Purchase',
						'priceIndex': this.state.rpPurchaseForm.priceIndex
					}
				}).then((response) => {
					if (response.charge.status === 'succeeded') {
						this.showAlert('orderSuccess');
						this.setState({
							'rpPurchaseForm': {
								'priceIndex': ''
							},
							'formIsActive': false
						}, () => {
							setTimeout(() => {
								this.setState({
									'formIsActive': true
								});
							});
						});
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
                'key': env.stripe.publishable,
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
        this.stripehandler.open({
			'name': 'Battle-Comm',
            'description': 'Reward Point Purchase',
			'amount': pointPriceConfig[this.state.rpPurchaseForm.priceIndex].value,
			'email': this.state.rpPurchaseForm.email,
            'panelLabel': 'Complete Order',
			'zipCode': true
        });
        e.preventDefault();
    }

	showAlert(selector) {
		const alerts = {
			'orderSuccess': () => {
				let rp = pointPriceConfig[this.state.rpPurchaseForm.priceIndex].rp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				this.props.addAlert({
					'title': 'Order Success',
					'message': `Your RP pool has been updated and ${rp}RP were added to your account.`,
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
								<Select name="priceIndex" value={this.state.rpPurchaseForm.priceIndex} handleInputChange={this.handleInputChange} required={true}>
									<option value="">--Select--</option>
									{
										pointPriceConfig.map((option, i) =>
											<option key={i} value={i}>{option.display}</option>
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
			                {
								this.state.stripeLoading ?
								<p>loading..</p> :
								<button className="button secondary" onClick={this.openStripeModal} disabled={formIsInvalid}>Checkout</button>
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

export default withRouter(connect(null, mapDispatchToProps)(RewardPointPurchase));
