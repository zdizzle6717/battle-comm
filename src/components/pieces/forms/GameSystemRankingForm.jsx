'use strict';

import React from 'react';
import {browserHistory} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import PropTypes from 'prop-types';
import {AlertActions} from '../../../library/alerts';
import {handlers} from '../../../library/utilities';
import {Form, Input, TextArea, Select} from '../../../library/validations';
import FactionActions from '../../../actions/FactionActions';
import GameSystemActions from '../../../actions/GameSystemActions';
import GameSystemRankingService from '../../../services/GameSystemRankingService';
import GameSystemService from '../../../services/GameSystemService';

const mapStateToProps = (state) => {
	return {
		'gameSystems': state.gameSystems
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'getGameSystems': GameSystemActions.get
	}, dispatch);
}

class GameSystemRankingForm extends React.Component {
	constructor() {
		this.state = {
			'ranking': {},
			'factions': []
		}

		this.handleGameSystemChange = this.handleGameSystemChange.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
	}

	componentDidMount() {
		this.props.getGameSystems();
	}

	handleGameSystemChange(e) {
		let ranking = this.state.ranking;
		ranking.GameSystemId = e.target.value;
		ranking.FactionId = undefined;
		GameSystemService.get(e.target.value).then((gameSystem) => {
			this.setState({
				'factions': gameSystem.Factions,
				'ranking': ranking
			});
		});
	}

	handleInputChange(e) {
		this.setState({
			'ranking': handlers.updateInput(e, this.state.ranking)
		});
	}

	handleSubmit() {
		let newRanking = this.state.ranking;
		newRanking.UserId = this.props.playerId;
		GameSystemRankingService.createOrUpdate(newRanking).then((ranking) => {
			this.setState({
				'ranking': ranking
			});
			this.addAlert('rankingUpdated');
			browserHistory.push('/admin');
		});
	}

	showAlert(selector) {
		const alerts = {
			'rankingUpdated': () => {
				this.props.addAlert({
					'title': 'Player Ranking Updated',
					'message': `Ranking was successfully updated and incremented for ${this.props.playerName}`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

	render() {
		<div>
			<Form name="rankingForm" submitText="Updated Player Ranking" handleSubmit={this.handleSubmit}>
				<div className="row">
					<div className="form-group small-12 medium-6 columns">
						<label className="required">Game System</label>
						<Select name="GameSystemId" value={this.state.ranking.GameSystemId} handleInputChange={this.handleGameSystemChange} required={true}>
							<option value="">--Select--</option>
							{
								this.props.gameSystems.map((gameSystem, i) =>
									<option key={i} value={gameSystem.id}>{gameSystem.name}</option>
								)
							}
						</Select>
					</div>
					<div className="form-group small-12 medium-6 columns">
						<label className="required">Faction</label>
						<Select name="FactionId" value={this.state.ranking.FactionId} handleInputChange={this.handleInputChange} required={true}>
							<option value="">--Select--</option>
							{
								this.state.factions.map((faction, i) =>
									<option key={i} value={faction.id}>{faction.name}</option>
								)
							}
						</Select>
					</div>
				</div>
				<div className="row">
					<div className="form-group small-12 medium-4 columns">
						<label className="required">Total Wins</label>
						<Input type="text" name="totalWins" value={this.state.ranking.totalWins} handleInputChange={this.handleInputChange} required={true} />
					</div>
					<div className="form-group small-12 medium-4 columns">
						<label className="required">Total Draws</label>
						<Input type="text" name="totalDraws" value={this.state.ranking.totalDraws} handleInputChange={this.handleInputChange} required={true} />
					</div>
					<div className="form-group small-12 medium-4 columns">
						<label className="required">Total Losses</label>
						<Input type="text" name="totalLosses" value={this.state.ranking.totalLosses} handleInputChange={this.handleInputChange} required={true} />
					</div>
				</div>
			</Form>
		</div>
	}
}

GameSystemRankingForm.propTypes = {
	'playerId': PropTypes.number,
	'playerName': PropTypes.string
}

GameSystemRankingForm.defaultProps = {
}

export default connect(mapStateToProps, mapDispatchToProps)(GameSystemRankingForm);
