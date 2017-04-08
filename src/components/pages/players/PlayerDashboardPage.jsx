'use strict';

import React from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import {getFormErrorCount, Form, Input, Select, TextArea, CheckBox, RadioGroup, FileUpload} from '../../../library/validations';
import {handlers} from '../../../library/utilities';
import ViewWrapper from '../../ViewWrapper';
import PlayerService from '../../../services/PlayerService';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms,
		'user': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class PlayerDashboardPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'currentUser': {
				'Friends': [],
				'GameSystemRankings': []
			},
			'isEditing': {
				'bio': false,
				'links': false
			}
		};

		this.cancelEdit = this.cancelEdit.bind(this);
		this.getCurrentPlayer = this.getCurrentPlayer.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.savePlayer = this.savePlayer.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Dashboard";
		// TODO: Verify that this check is necessary
		if (!this.props.user.id) {
			browserHistory.push('/');
		} else {
			this.getCurrentPlayer();
		}
    }

	cancelEdit() {
		let isEditing = this.state.isEditing;
		for (let prop in isEditing) {
			isEditing[prop] = false;
		}
		this.setState({
			'isEditing': isEditing
		});
		this.getCurrentPlayer();
	}

	getCurrentPlayer() {
		PlayerService.getById(this.props.user.id).then((currentUser) => {
			this.setState({
				'currentUser': currentUser
			});
		});
	}

	handleInputChange(e) {
		this.setState({
			'currentUser': handlers.updateInput(e, this.state.currentUser)
		});
	}

	handleSubmit(identifier) {
		return;
	}

	savePlayer() {
		PlayerService.update(this.state.currentUser.id, this.state.currentUser).then((updatedUser) => {
			let isEditing = this.state.isEditing;
			for (let prop in isEditing) {
				isEditing[prop] = false;
			}
			this.setState({
				'isEditing': isEditing
			});
			this.getCurrentPlayer();
			this.showAlert('playerUpdated');
		});
	}

	showAlert(selector) {
		const alerts = {
			'playerUpdated': () => {
				this.props.addAlert({
					'title': 'Profile Updated',
					'message': `Your profile was successfully updated`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

	toggleEdit(identifier) {
		let isEditing = this.state.isEditing;
		for (let prop in isEditing) {
			isEditing[prop] = false;
		}
		isEditing[identifier] = true;
		this.setState({
			'isEditing': isEditing
		});
		this.getCurrentPlayer();
	}

    render() {
		let currentUser = this.state.currentUser;
		let isEditing = this.state.isEditing;
		let bioFormIsValid = getFormErrorCount(this.props.forms, 'bioForm') < 1;
		let linksFormIsValid = getFormErrorCount(this.props.forms, 'linksForm') < 1;

        return (
            <ViewWrapper>
				<div className="player-dashboard">
					<div className="row">
						<div className="small-12 columns">
							<h1>Player Dashboard</h1>
						</div>
	                </div>
					<div className="row">
						<div className="small-12 medium-6 columns">
							<h2 className="no-shadow text-center">Player Bio</h2>
							<div className={isEditing.bio ? 'editable active': 'editable'}>
								{
									isEditing.bio ?
									<Form name="bioForm" handleSubmit={this.handleSubmit.bind(this, 'bio')} submitButton={false}>
										<div className="form-group inline">
											<label className="title bold">Bio:</label>
											<TextArea name="bio" id="bio" rows={4} value={currentUser.bio} maxlength="500"  handleInputChange={this.handleInputChange} />
										</div>
									</Form> :
									<div>
										<label className="title">Bio:</label>
										<p className="user-bio">{currentUser.bio}
										</p>
									</div>
								}
								{
									isEditing.bio ?
									<div className="action-group">
										<button className="cancel" onClick={this.cancelEdit}>
											<span className="fa fa-times"></span>
										</button>
										<button className="save" onClick={this.savePlayer} disabled={!bioFormIsValid}>
											<span className="fa fa-check"></span>
										</button>
									</div> :
									<div className="action-group">
										<button className="edit" onClick={this.toggleEdit.bind(this, 'bio')}>
											<span className="fa fa-edit"></span>
										</button>
									</div>
								}
							</div>
							<h2 className="push-top-2x text-center">Social Links</h2>
							<div className={isEditing.links ? 'editable active': 'editable'}>
								{
									isEditing.links ?
									<Form name="linksForm" handleSubmit={this.handleSubmit.bind(this, 'links')} submitButton={false}>
										<div className="form-group inline">
											<label className="title bold">Facebook:</label>
											<Input name="facebook" type="url" id="facebook" placeholder="http://..." value={currentUser.facebook} handleInputChange={this.handleInputChange} />
										</div>
										<div className="form-group inline">
											<label className="title bold">Twitter:</label>
											<Input name="twitter" type="url" id="twitter" placeholder="http://..." value={currentUser.twitter} handleInputChange={this.handleInputChange} />
										</div>
										<div className="form-group inline">
											<label className="title bold">Instagram:</label>
											<Input name="instagram" type="url" id="instagram" placeholder="http://..." value={currentUser.instagram} handleInputChange={this.handleInputChange} />
										</div>
										<div className="form-group inline">
											<label className="title bold">Twitch:</label>
											<Input name="twitch" type="url" id="twitch" placeholder="http://..." value={currentUser.twitch} handleInputChange={this.handleInputChange} />
										</div>
										<div className="form-group inline">
											<label className="title bold">Google +:</label>
											<Input name="googlePlus" type="url" id="googlePlus" placeholder="http://..." value={currentUser.googlePlus} handleInputChange={this.handleInputChange} />
										</div>
										<div className="form-group inline">
											<label className="title bold">Website:</label>
											<Input name="website" type="url" id="website" placeholder="http://..." value={currentUser.website} handleInputChange={this.handleInputChange} />
										</div>
									</Form> :
									<ul className="list user-social">
										<li className="">Facebook: <a href={currentUser.facebook} target="_blank">{currentUser.facebook}</a></li>
										<li className="">Twitter:<a href={currentUser.twitter} target="_blank"> {currentUser.twitter}</a></li>
										<li className="">Instagram: <a href={currentUser.instagram} target="_blank">{currentUser.instagram}</a></li>
										<li className="">Twitch: <a href={currentUser.twitch} target="_blank">{currentUser.twitch}</a></li>
										<li className="">Google +: <a href={currentUser.googlePlus} target="_blank">{currentUser.googlePlus}</a></li>
										<li className="">Custom Url: <a href={currentUser.website} target="_blank">{currentUser.website}</a></li>
									</ul>
								}
								{
									isEditing.links ?
									<div className="action-group">
										<button className="cancel" onClick={this.cancelEdit}>
											<span className="fa fa-times"></span>
										</button>
										<button className="save" onClick={this.savePlayer} disabled={!linksFormIsValid}>
											<span className="fa fa-check"></span>
										</button>
									</div> :
									<div className="action-group">
										<button className="edit" onClick={this.toggleEdit.bind(this, 'links')}>
											<span className="fa fa-edit"></span>
										</button>
									</div>
								}
							</div>
							<div className="row push-top-2x">
								<div className="small-12 columns">
									<Link key="editAccountDetails" to="/players/dashboard/account-edit"><h3 className="button account-details text-center">Edit Account Details</h3></Link>
								</div>
							</div>
						</div>
						<div className="small-12 medium-6 columns text-center">
							<h2 className="no_shadow">{ currentUser.firstName ? (currentUser.firstName + ' ' + currentUser.lastName) : 'Anonymous'} </h2>
							<div className="text-center">
								<h3 className="gold-label">RP Stash: <span><strong>{currentUser.rewardPoints || 0}</strong> Points</span></h3>
								<div className="flex-row-center push-top">
									<div className="profile-picture">
										<img src={`/uploads/players/${currentUser.id}/playerIcon/${currentUser.icon}`} alt={currentUser.username} className="shadow"/>
									</div>
								</div>
							</div>
							<h1 className="push-top"><Link key="userProfile" to={`/players/profile/${currentUser.username}`} className="username">{currentUser.username}</Link></h1>
							<div className="">
								<p><Link to={`/players/dashboard/change-password`}>Change Password?</Link></p>
							</div>
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Allies <Link key="allyList" to={`/players/profile/${currentUser.username}/ally-search`} className="right">View All</Link></h2>
							<div className="friend-list">
								{
									currentUser.Friends.map((friend, i) =>
									<span className="icon-box">
										<Link key={i} to={`/players/profile/${friend.username}`} className="icon-box">
											<img className="icon" src={`/uploads/players/${friend.id}/playerIcon/thumbs/${friend.icon}`} />
											<span className="name-label">{friend.firstName} {friend.lastName}</span>
										</Link>
									</span>
									)
								}
							</div>
							{
								currentUser.Friends.length < 1 &&
								<h5 className="text-center">Search by player profile and click 'Add Ally' to send a ally request.</h5>
							}
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Achievements</h2>
							<h3 className="text-center">Achievements have not yet been awarded.</h3>
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Player Ranking <Link key="playerRanking" to="ranking/search/all" className="right"><span className="fa fa-list-ol"></span> Leaderboards</Link></h2>
							<div className="small-12 columns">
								{
									currentUser.GameSystemRankings.length < 1 &&
									<h3 className="text-center">Submit game results to a Battle-Comm participating event/venue administrator to have your ranking submitted to the BC leaderboards.</h3>
								}
								{
									currentUser.GameSystemRankings.map((gameRanking, i) =>
									<div key={i} className="row">
										<h4><Link key={`gameSystemRanking-${i}`} to={`/ranking/search/${gameRanking.GameSystemId}`}>{gameRanking.GameSystem.name}</Link>: {gameRanking.totalWins}/{gameRanking.totalLosses}/{gameRanking.totalDraws}</h4>
										<table className="search-results">
											<tr>
												<th>Game System</th>
												<th>Faction</th>
												<th>Ranking W/L/D</th>
												<th>Point Value</th>
											</tr>
											{
												gameRanking.FactionRankings.map((factionRanking, j) =>
													<tr key={j} className="item">
														<td><Link key={`gameSystemRanking-${i}`} to={`/ranking/search/${gameRanking.GameSystemId}`}>{gameRanking.GameSystem.name}</Link></td>
														<td><Link key={`gameSystemRanking-${i}`} to={`/ranking/search/${gameRanking.GameSystemId}/${factionRanking.FactionId}`}>{factionRanking.Faction.name}</Link></td>
														<td>{factionRanking.totalWins}/{factionRanking.totalLosses}/{factionRanking.totalDraws}</td>
														<td>{factionRanking.pointValue}</td>
													</tr>
												)
											}
										</table>
										<hr />
									</div>
									)
								}
							</div>
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Photostream <div className="right"><a><span className="fa fa-upload"></span> Add Photo</a></div></h2>
							TODO: Add file upload
							TODO: Add popup component and list of player images
							<div className="text-center">
								<h5>Upload photos from you dashboard to share your table-top experience with friends.</h5>
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PlayerDashboardPage);
