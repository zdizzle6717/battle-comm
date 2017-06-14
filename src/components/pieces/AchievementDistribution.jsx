'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import {AlertActions} from '../../library/alerts';
import {FormActions} from '../../library/validations';
import {handlers} from '../../library/utilities';
import searchSuggestions from '../../library/searchSuggestions';
import {Form, getFormErrorCount, Input, TextArea, Select} from '../../library/validations';
import PlayerService from '../../services/PlayerService';
import AchievementService from '../../services/AchievementService';
import UserAchievementService from '../../services/UserAchievementService';
let SearchSuggestions = searchSuggestions(PlayerService, 'searchSuggestions');

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

// TODO: add proptypes config

let timer;

class AchievementDistribution extends React.Component {
	constructor() {
		super();

		this.state = {
			'achievements': [],
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

	componentDidMount() {
		AchievementService.getAll().then((achievements) => {
			this.setState({
				'achievements': achievements
			});
		});
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
			UserAchievementService.create({
				'UserId': this.state.rpForm.receivingPlayerId,
				'AchievementTitle': this.state.rpForm.achievementTitle,
				'notify': true
			}).then(() => {
				this.resetForm();
				this.showAlert('achievementAssigned');
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
			'achievementAssigned': () => {
				this.props.addAlert({
					'title': 'Achievement Assigned',
					'message': `A new achiement has successfully been assigned to the selected player.`,
					'type': 'success',
					'delay': 4000
				});
			}
		}

		return alerts[selector]();
	}

	render() {
		let formIsInvalid = !this.state.validUser || getFormErrorCount(this.props.forms, 'achievementDistForm') > 0;

		return (
			<div className="small-12 columns">
				<h2>Assign Achievements</h2>
				<div className="row">
					<div className="small-12 columns">
						{
							this.state.formIsActive &&
							<Form name="achievementDistForm" submitButton={false}>
								<div className="row">
									<div className="form-group small-12 medium-4 medium-offset-2 columns">
										<label className="required">Assign to Player...</label>
										<SearchSuggestions rowCount={7} maxResults={20} name="receivingPlayerId" displayKeys={['id', 'lastName', 'firstName', 'username']} placeholder="Begin typing to search players..." handleInputChange={this.handleSearchSuggestionChange} required={true}/>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Achievement</label>
										<Select name="achievementTitle" value={this.state.rpForm.achievementTitle} handleInputChange={this.handleInputChange} required={true}>
											<option value="">--Select--</option>
											{
												this.state.achievements.map((achievement) =>
													<option key={achievement.id} value={achievement.title}>{achievement.title}</option>
												)
											}
										</Select>
									</div>
								</div>
							</Form>
						}
						<div className="form-group text-right">
							<button className="button primary" onClick={this.handleSubmit} disabled={formIsInvalid}>Update Player Achievements</button>
						</div>
					</div>
				</div>
			</div>
		)
	}

	componentWillUnmount() {
		if (timer) {
			clearTimeout(timer);
		}
	}
}

export default withRouter(connect(null, mapDispatchToProps)(AchievementDistribution));
