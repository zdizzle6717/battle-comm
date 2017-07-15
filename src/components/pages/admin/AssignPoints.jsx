'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import {AlertActions} from '../../../library/alerts';
import {handlers} from '../../../library/utilities';
import {UserActions} from '../../../library/authentication';
import {Form, getFormErrorCount, Input, TextArea, Select, DatePicker} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import GameSystemActions from '../../../actions/GameSystemActions';
import GameSystemService from '../../../services/GameSystemService';
import VenueService from '../../../services/VenueService';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms,
		'gameSystems': state.gameSystems,
		'user': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'getGameSystems': GameSystemActions.getAll,
		'modifyUser': UserActions.modify,
	}, dispatch);
}

class AssignPoints extends React.Component {
	constructor() {
		super();

		this.state = {
			'factions': [[]],
			'selectedGameSystems': [''],
			'players': [{
				'faction': '',
				'gameSystem': ''
			}],
			'venueEvent': {
				'eventDate': ''
			},
		}

		this.addPlayer = this.addPlayer.bind(this);
		this.assignmentFormsAreInvalid = this.assignmentFormsAreInvalid.bind(this);
		this.handleEventInputChange = this.handleEventInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
	}

	componentDidMount() {
		document.title = "Battle-Comm | RP Assignment";
		this.props.getGameSystems();
		this.setState({
			'venueEvent': {
				'venueAdmin': this.props.user.firstName + ' ' + this.props.user.lastName
			}
		})
	}

	addPlayer() {
		let players = this.state.players;
		let factions = this.state.factions;
		let selectedGameSystems = this.state.selectedGameSystems;
		factions[players.length] = [];
		selectedGameSystems[players.length] = '';
		players[players.length] = {
			'faction': '',
			'gameSystem': ''
		};

		this.setState({
			'factions': factions,
			'players': players,
			'selectedGameSystems': selectedGameSystems
		});
	}

	assignmentFormsAreInvalid() {
		let venueEventFormIsInvalid = getFormErrorCount(this.props.forms, 'venueEventForm') > 0;
		let playerFormsAreInvalid = this.state.players.some((player, i) => {
			return getFormErrorCount(this.props.forms, `venueEventPlayersForm-${i}`) > 0;
		})
		let totalPoints = 0;
		this.state.players.forEach((player) => {
			totalPoints += player.pointsEarned;
		});
		let notEnoughPoints = totalPoints > this.props.user.rpPool;
		return venueEventFormIsInvalid || playerFormsAreInvalid || this.state.players.length < 1 || notEnoughPoints;
	}

	handleEventInputChange(e) {
		this.setState({
			'venueEvent': handlers.updateInput(e, this.state.venueEvent)
		});
	}

	handleGameSystemChange(index, e) {
		let players = this.state.players;
		players[index].faction = '';
		let factions = this.state.factions;
		let selectedGameSystems = this.state.selectedGameSystems;
		selectedGameSystems[index] = e.target.value;
		GameSystemService.get(e.target.value).then((gameSystem) => {
			factions[index] = gameSystem.Factions;
			players[index].gameSystem = gameSystem.name;
			this.setState({
				'players': players,
				'factions': factions,
				'selectedGameSystems': selectedGameSystems
			});
		});
	}

	handlePlayerInputChange(index, e) {
		let players = this.state.players;
		players[index][e.target.name] = e.target.value;
		this.setState({
			'players': players
		});
	};

	handleSubmit() {
		let data = {
			'venueEvent': this.state.venueEvent,
			'players': this.state.players
		};
		data.venueEvent.adminUsername = this.props.user.username;
		VenueService.submitPointAssignment(data).then((response) => {
			this.props.modifyUser({
				'rpPool': response.rpPool
			});
			this.showAlert('pointsSubmitted');
			this.props.history.push('/players/dashboard');
		});
	}

	removePlayer(index, e) {
		e.preventDefault();
		let players = this.state.players;
		let factions = this.state.factions;
		let selectedGameSystems = this.state.selectedGameSystems;
		players.splice(index, 1);
		factions.splice(index, 1);
		selectedGameSystems.splice(index, 1);
		this.setState({
			'players': players,
			'factions': factions,
			'selectedGameSystems': selectedGameSystems
		});
	}

	showAlert(selector) {
		const alerts = {
			'pointsSubmitted': () => {
				this.props.addAlert({
					'title': 'Point Assignment Submitted',
					'message': `An e-mail has been sent to the site admin. Please allow a few days for a response.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'notEnoughRp': () => {
				this.props.addAlert({
					'title': 'RP Pool is Empty',
					'message': `Your RP pool is currently empty. E-mail us at support@Battle-Comm.net and ask about purchasing RP for an event or being sponsored by Battle-Comm.`,
					'type': 'info',
					'delay': 5000
				});
			}
		}

		return alerts[selector]();
	}

	render() {
		return (
			<ViewWrapper headerImage="/images/Titles/Reward_Point_Assignment.png" headerAlt="Reward Point Assignment">
				<div className="row">
					<div className="small-12 columns">
						<hr/>
						<AdminMenu></AdminMenu>
						<hr/>
					</div>
				</div>
				<div className="row">
					<div className="small-12 columns">
						<h2>Venue / Event</h2>
						<h3 className="text-center">You currently have {this.props.user.rpPool} Reward Points for distribution</h3>
						<hr/>
						<Form name="venueEventForm" submitText="Submit Point Assignment" submitButton={false}>
							<div className="row">
								<div className="form-group small-12 medium-4 columns">
									<label className="required">Venue Name</label>
									<Input type="text" name="venueName" value={this.state.venueEvent.venueName} handleInputChange={this.handleEventInputChange} required={true} />
								</div>
								<div className="form-group small-12 medium-4 columns">
									<label className="required">Venue Admin</label>
									<Input type="text" name="venueAdmin" value={this.state.venueEvent.venueAdmin} handleInputChange={this.handleEventInputChange} required={true} />
								</div>
								<div className="form-group small-12 medium-4 columns">
									<label className="required">Event Name</label>
									<Input type="text" name="eventName" value={this.state.venueEvent.eventName} handleInputChange={this.handleEventInputChange} required={true} />
								</div>
							</div>
							<div className="row">
								<div className="form-group small-12 medium-6 columns">
									<label className="required">Event Date</label>
									<DatePicker name="eventDate" value={this.state.venueEvent.eventDate} handleInputChange={this.handleEventInputChange} required={true} />
								</div>
								<div className="form-group small-12 medium-6 columns">
									<label className="required">Return Email</label>
									<Input type="text" name="returnEmail" value={this.state.venueEvent.returnEmail} handleInputChange={this.handleEventInputChange} validate="email" required={true} />
								</div>
							</div>
						</Form>

						<h2>Players</h2>
						{
							this.state.players.map((player, i) =>
								<Form key={i} name={`venueEventPlayersForm-${i}`} submitText="Submit Point Assignment" submitButton={false}>
									<fieldset>
										<div className="row">
											<div className="form-group small-12 medium-4 columns">
												<label className="required">Full Name</label>
												<Input type="text" name="fullName" value={this.state.players[i].fullName} handleInputChange={this.handlePlayerInputChange.bind(this, i)} required={true} />
											</div>
											<div className="form-group small-12 medium-4 columns">
												<label className="required">Email</label>
												<Input type="text" name="email" value={this.state.players[i].email} handleInputChange={this.handlePlayerInputChange.bind(this, i)} validate="email" required={true} />
											</div>
											<div className="form-group small-12 medium-4 columns">
												<label className="required">Points Earned</label>
												<Input type="number" name="pointsEarned" value={this.state.players[i].pointsEarned} handleInputChange={this.handlePlayerInputChange.bind(this, i)} required={true} />
											</div>
										</div>
										<div className="row">
											<div className="form-group small-12 medium-6 columns">
												<label className="required">Game System</label>
												<Select name="selectedGameSystems" value={this.state.selectedGameSystems[i].gameSystem} handleInputChange={this.handleGameSystemChange.bind(this, i)} required={true}>
													<option value="">--Select--</option>
													{
														this.props.gameSystems.map((gameSystem, i) =>
															<option key={gameSystem.id} value={gameSystem.id}>{gameSystem.name}</option>
														)
													}
												</Select>
											</div>
											<div className="form-group small-12 medium-6 columns">
												<label>Faction</label>
												<Select name="faction" value={this.state.players[i].faction} handleInputChange={this.handlePlayerInputChange.bind(this, i)}>
													<option value="">--Select--</option>
													{
														this.state.factions[i].map((faction, i) =>
															<option key={faction.id} value={faction.name}>{faction.name}</option>
														)
													}
												</Select>
											</div>
										</div>
										<div className="row">
											<div className="form-group small-12 medium-4 columns">
												<label className="required">Total Wins</label>
												<Input type="number" name="totalWins" value={this.state.players[i].totalWins} handleInputChange={this.handlePlayerInputChange.bind(this, i)} required={true} />
											</div>
											<div className="form-group small-12 medium-4 columns">
												<label className="required">Total Losses</label>
												<Input type="number" name="totalLosses" value={this.state.players[i].totalLosses} handleInputChange={this.handlePlayerInputChange.bind(this, i)} required={true} />
											</div>
											<div className="form-group small-12 medium-4 columns">
												<label className="required">Total Draws</label>
												<Input type="number" name="totalDraws" value={this.state.players[i].totalDraws} handleInputChange={this.handlePlayerInputChange.bind(this, i)} required={true} />
											</div>
										</div>
										<div className="row">
											<div className="form-group small-12 columns">
												<label className="required">List of Achievements Earned</label>
												<TextArea type="text" name="achievementsList" value={this.state.players[i].achievementsList} rows="1" handleInputChange={this.handlePlayerInputChange.bind(this, i)} />
											</div>
										</div>
										{
											i > 0 &&
											<button className="button error" onClick={this.removePlayer.bind(this, i)}><span className="fa fa-minus"></span></button>
										}
									</fieldset>
								</Form>
							)
						}
						<div className="form-group">
							<button className="button" onClick={this.addPlayer}><span className="fa fa-plus"></span> Add Player</button>
						</div>

						<div className="form-group text-right">
							<button className="button right" onClick={this.handleSubmit} disabled={this.assignmentFormsAreInvalid()}>Submit Point Assignment</button>
						</div>
					</div>
				</div>
			</ViewWrapper>
		)
	}
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(AssignPoints));
