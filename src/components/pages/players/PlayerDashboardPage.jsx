'use strict';

import React from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import {getFormErrorCount, Form, Input, Select, TextArea, CheckBox, RadioGroup, FileUpload} from '../../../library/validations';
import {handlers, uploadFiles} from '../../../library/utilities';
import ViewWrapper from '../../ViewWrapper';
import PlayerService from '../../../services/PlayerService';
import FileService from '../../../services/FileService';

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
				'Files': [],
				'Friends': [],
				'GameSystemRankings': []
			},
			'fileUpload': [],
			'isEditing': {
				'bio': false,
				'links': false
			}
		};

		this.cancelEdit = this.cancelEdit.bind(this);
		this.getCurrentPlayer = this.getCurrentPlayer.bind(this);
		this.getPlayerIcon = this.getPlayerIcon.bind(this);
		this.handlePhotoStreamUpload = this.handlePhotoStreamUpload.bind(this);
		this.handlePlayerIconUpload = this.handlePlayerIconUpload.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.savePlayer = this.savePlayer.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.uploadFiles = this.uploadFiles.bind(this);
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
		return PlayerService.getById(this.props.user.id).then((currentUser) => {
			this.setState({
				'currentUser': currentUser
			});
		});
	}

	getPlayerIcon() {
		let fileName;
		this.state.currentUser.Files.forEach((file, i) => {
			if (file.identifier === 'playerIcon') {
				fileName = file.name;
			}
		});
		return fileName ? `/uploads/players/${this.state.currentUser.id}/playerIcon/${fileName}` : '/uploads/players/defaults/profile-icon-default.png';
	}

	handleDeleteFile(fileId) {
		FileService.remove(fileId).then(() => {
			this.showAlert('fileRemoved');
		});
	}

	handlePlayerIconUpload(files) {
		// TODO: Make sure that only first file gets uploaded
		this.uploadFiles([files[0]], 'playerIcon').then((responses) => {
			let file = {
				'name': responses[0].data.file.name,
				'size': responses[0].data.file.size,
				'type': responses[0].data.file.type,
				'identifier': 'playerIcon',
				'UserId': this.state.currentUser.id
			};
			let fileName, iconFile;
			this.state.currentUser.Files.forEach((file, i) => {
				if (file.identifier === 'playerIcon') {
					iconFile = file;
					iconFile.UserId = this.state.currentUser.id;
				}
			});
			let method = iconFile ? 'update': 'create';
			FileService[method]((iconFile ? iconFile.id : file), (iconFile ? file : null)).then((file) => {
				console.log(file);
				this.getCurrentPlayer().then(() => {
					// TODO: Reset File Upload input so user isn't blocked from uploading new file
					this.setState({
						'fileUpload': []
					});
					this.showAlert('uploadSuccess');
				});
			});
		});
	}

	handlePhotoStreamUpload(files) {
		// TODO: Configure this and decide whether to keep UserPhotos database model
		this.uploadFiles(files, 'photoStream').then((responses) => {
			responses = responses.map((response, i) => {
				response = {
					'name': response.data.file.name,
					'size': response.data.file.size,
					'type': response.data.file.type
				};
				return response;
			});
			this.getCurrentPlayer().then(() => {
				this.showAlert('uploadSuccess');
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
			},
			'uploadSuccess': () => {
				this.props.addAlert({
					'title': 'Upload Success',
					'message': 'New files were successfully updated',
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

	uploadFiles(files, identifier) {
		let directoryPath = `players/${this.state.currentUser.id}/${identifier}/`;
		return uploadFiles(files, '/files/add', directoryPath, {
			'identifier': identifier
		});
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
								<Form name="bioForm" handleSubmit={this.handleSubmit.bind(this, 'bio')} submitButton={false}>
									<div className="form-group">
										<TextArea name="bio" id="bio" rows="4" value={currentUser.bio} maxlength="500"  handleInputChange={this.handleInputChange} disabled={!isEditing.bio}/>
									</div>
								</Form>
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
								<Form name="linksForm" handleSubmit={this.handleSubmit.bind(this, 'links')} submitButton={false}>
									<div className="form-group">
										<label className="title bold">Facebook</label>
										{
											(isEditing.links || currentUser.facebook) &&
											<Input name="facebook" type="url" id="facebook" placeholder="https://..." value={currentUser.facebook} handleInputChange={this.handleInputChange} disabled={!isEditing.links}/>
										}
									</div>
									<div className="form-group">
										<label className="title bold">Twitter</label>
											{
												(isEditing.links || currentUser.twitter) &&
												<Input name="twitter" type="url" id="twitter" placeholder="https://..." value={currentUser.twitter} handleInputChange={this.handleInputChange} disabled={!isEditing.links}/>
											}
									</div>
									<div className="form-group">
										<label className="title bold">Instagram</label>
											{
												(isEditing.links || currentUser.instagram) &&
												<Input name="instagram" type="url" id="instagram" placeholder="https://..." value={currentUser.instagram} handleInputChange={this.handleInputChange} disabled={!isEditing.links}/>
											}
									</div>
									<div className="form-group">
										<label className="title bold">Twitch</label>
											{
												(isEditing.links || currentUser.twitch) &&
												<Input name="twitch" type="url" id="twitch" placeholder="https://..." value={currentUser.twitch} handleInputChange={this.handleInputChange} disabled={!isEditing.links}/>
											}
									</div>
									<div className="form-group">
										<label className="title bold">Google +</label>
											{
												(isEditing.links || currentUser.googlePlus) &&
												<Input name="googlePlus" type="url" id="googlePlus" placeholder="https://..." value={currentUser.googlePlus} handleInputChange={this.handleInputChange} disabled={!isEditing.links}/>
											}
									</div>
									<div className="form-group">
										<label className="title bold">Website</label>
											{
												(isEditing.links || currentUser.website) &&
												<Input name="website" type="url" id="website" placeholder="https://..." value={currentUser.website} handleInputChange={this.handleInputChange} disabled={!isEditing.links}/>
											}
									</div>
								</Form>
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
										<img src={this.getPlayerIcon()} alt={currentUser.username} className="shadow"/>
										<Form name="playerIconForm" submitButton={false}>
											<FileUpload name="playerIcon" value={this.state.fileUpload} handleFileUpload={this.handlePlayerIconUpload} accept="image/*" maxFiles={10} hideFileList={true}/>
										</Form>
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
											<thead>
												<tr>
													<th>Game System</th>
													<th>Faction</th>
													<th>Ranking W/L/D</th>
													<th>Point Value</th>
												</tr>
											</thead>
											<tbody>
												{
													gameRanking.FactionRankings.map((factionRanking, j) =>
														<tr key={j} className="item">
															<td><Link key={`gameSystemRanking-${i}`} to={`/ranking/search/${gameRanking.GameSystemId}`} className="color-black">{gameRanking.GameSystem.name}</Link></td>
															<td><Link key={`gameSystemRanking-${i}`} to={`/ranking/search/${gameRanking.GameSystemId}/${factionRanking.FactionId}`} className="color-black">{factionRanking.Faction.name}</Link></td>
															<td>{factionRanking.totalWins}/{factionRanking.totalLosses}/{factionRanking.totalDraws}</td>
															<td>{factionRanking.pointValue}</td>
														</tr>
													)
												}
											</tbody>
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
