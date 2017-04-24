'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import {AlertActions} from '../../library/alerts';
import {FormActions} from '../../library/validations';
import {UserActions} from '../../library/authentication';
import {handlers} from '../../library/utilities';
import searchSuggestions from '../../library/SearchSuggestions';
import {Form, getFormErrorCount, Input, TextArea, Select} from '../../library/validations';
import PlayerService from '../../services/PlayerService';
let SearchSuggestions = searchSuggestions(PlayerService, 'searchSuggestions');

const mapStateToProps = (state) => {
	return {
		'forms': state.forms,
		'user': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'modifyUser': UserActions.modify,
		'resetForm': FormActions.resetForm
	}, dispatch);
}

// TODO: Properly reset form fields

let timer;

class RPDistributionManagement extends React.Component {
	constructor() {
		super();

		this.state = {
			'formIsActive': true,
			'rpForm': {},
			'validUser': false
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.handleSearchSuggestionChange = this.handleSearchSuggestionChange.bind(this);
		this.resetForm = this.resetForm.bind(this);
		this.showAlert = this.showAlert.bind(this);
	}

	componentWillUnmount() {
		if (timer) {
			clearTimeout(timer);
		}
	}

	handleInputChange(e) {
		this.setState({
			'rpForm': handlers.updateInput(e, this.state.rpForm)
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		if (timer) {
			clearTimeout(timer);
		}
		timer = setTimeout(() => {
			PlayerService.updateRP(this.props.user.id, {
				'direction': 'decrement',
				'rewardPoints': this.state.rpForm.rpToTransfer
			});
			this.props.modifyUser({
				'rewardPoints': this.props.user.rewardPoints - this.state.rpForm.rpToTransfer
			});
			PlayerService.updateRP(this.state.rpForm.receivingPlayerId, {
				'direction': 'increment',
				'rewardPoints': this.state.rpForm.rpToTransfer
			}).then(() => {
				this.resetForm();
				this.showAlert('pointsSubmitted');
			});
		}, 300);
	}

	handleSearchSuggestionChange(e) {
		this.setState({
			'rpForm': handlers.updateSearchSuggestion(e, 'id', this.state.rpForm),
			'validUser': !!e.target.suggestionObject
		});
	}

	resetForm(e) {
		if (e) {
			e.preventDefault();
		}
		this.setState({
			'rpForm': {},
			'formIsActive': false
		}, () => {
			setTimeout(() => {
				this.setState({
					'formIsActive': true
				});
			});
		});
	}

	showAlert(selector) {
		const alerts = {
			'pointsSubmitted': () => {
				this.props.addAlert({
					'title': 'Point Assignment Submitted',
					'message': `A confirmation e-mail has been sent, and player points were automatically submitted.`,
					'type': 'success',
					'delay': 4000
				});
			}
		}

		return alerts[selector]();
	}

	render() {
		let formIsInvalid = !this.state.validUser || getFormErrorCount(this.props.forms, 'rewardPointForm') > 0;

		return (
			<div className="small-12 columns">
				<h2>Distribute Reward Points</h2>
				<div className="row">
					<div className="small-12 columns">
						<h3 className="small-12 text-center">Your Current RP: <strong>{this.props.user.rewardPoints}</strong></h3>
						{
							this.state.formIsActive &&
							<Form name="rewardPointForm" submitButton={false}>
								<div className="row">
									<div className="form-group small-12 medium-4 medium-offset-2 columns">
										<label className="required">Send to Player...</label>
										<SearchSuggestions rowCount={7} maxResults={20} name="receivingPlayerId" displayKeys={['id', 'lastName', 'firstName', 'username']} placeholder="Begin typing to search players..." handleInputChange={this.handleSearchSuggestionChange} required={true}/>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Reward Points</label>
										<Input type="number" name="rpToTransfer" value={this.state.rpForm.rpToTransfer} handleInputChange={this.handleInputChange} max={this.props.user.rewardPoints} required={true} />
									</div>
								</div>
							</Form>
						}
						<div className="form-group text-right">
							<button className="button primary" onClick={this.handleSubmit} disabled={formIsInvalid}>Submit RP Assignment</button>
						</div>
					</div>
				</div>
			</div>
		)
	}
}

export default connect(mapStateToProps, mapDispatchToProps)(RPDistributionManagement);
