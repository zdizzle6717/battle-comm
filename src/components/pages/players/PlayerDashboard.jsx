'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import axios from 'axios';
import {AlertActions} from '../../../library/alerts';
import {UserActions} from '../../../library/authentication';
import {FormActions} from '../../../library/validations';
import Modal from '../../../library/modal';
import {getFormErrorCount, Form, Input, Select, TextArea, CheckBox, RadioGroup, FileUpload} from '../../../library/validations';
import {handlers, uploadFiles} from '../../../library/utilities';
import ViewWrapper from '../../ViewWrapper';
import PlayerService from '../../../services/PlayerService';
import FileService from '../../../services/FileService';
import UserPhotoService from '../../../services/UserPhotoService';

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

class PlayerDashboard extends React.Component {
    constructor() {
        super();

		this.state = {
			'activeModal': 'none',
			'currentUser': {
				'UserAchievements': [],
				'Files': [],
				'Friends': [],
				'GameSystemRankings': []
			},
			'fileUploadIcon': [],
			'fileUploadPhotoStream': [],
			'isEditing': {
				'bio': false,
				'links': false
			},
			'photoStream': []
		};

		this.cancelEdit = this.cancelEdit.bind(this);
		this.createUserPhoto = this.createUserPhoto.bind(this);
		this.getCurrentPlayer = this.getCurrentPlayer.bind(this);
		this.getPlayerPhotoStream = this.getPlayerPhotoStream.bind(this);
		this.handlePhotoStreamUpload = this.handlePhotoStreamUpload.bind(this);
		this.handlePlayerIconUpload = this.handlePlayerIconUpload.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.savePlayer = this.savePlayer.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.uploadFiles = this.uploadFiles.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Dashboard";
		this.getCurrentPlayer().then(() => {
			this.getPlayerPhotoStream();
		});
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

	createUserPhoto(files) {
		this.uploadFiles([files[0]], 'playerIcon').then((responses) => {
			let file = {
				'name': responses[0].data.file.name,
				'size': responses[0].data.file.size,
				'type': responses[0].data.file.type,
				'UserId': this.state.currentUser.id,
				'identifier': 'playerIcon',
				'locationUrl': responses[0].data.file.locationUrl
			};
			let fileName, iconFile;
			this.state.currentUser.Files.forEach((file) => {
				if (file.identifier === 'playerIcon') {
					iconFile = file;
				}
			});
			let method = iconFile ? 'update': 'create';
			UserPhotoService[method]((iconFile ? iconFile.id : file), (iconFile ? file : null)).then((file) => {
				this.getCurrentPlayer().then(() => {
					this.setState({
						'fileUploadIcon': []
					});
					this.showAlert('uploadSuccess');
					this.props.resetForm('playerIconForm');
				});
			});
		}).catch((err) => {
			console.log(err);
		});
	}

	deletePhoto(id, index, e) {
		if (e) {
			e.preventDefault();
		}
		this.handleDeleteFile(id).then(() => {
			let photos = this.state.photoStream;
			photos.splice(index, 1);
			this.setState({
				'photoStream': photos
			});
		});
	}

	getCurrentPlayer() {
		return PlayerService.getById(this.props.user.id).then((currentUser) => {
			this.setState({
				'currentUser': currentUser
			});
			this.props.modifyUser(currentUser);
		});
	}

	getPlayerIcon(player) {
		let userPhoto = player.UserPhoto;
		return userPhoto ? `/uploads/players/${player.id}/playerIcon/300-${player.UserPhoto.name}` : '/uploads/players/defaults/profile-icon-default.png';
	}

	getPlayerPhotoStream() {
		let photos = this.state.currentUser.Files.filter((file) => file.identifier === 'photoStream');
		this.setState({
			'photoStream': photos
		});
	}

	handleDeleteFile(fileId) {
		return FileService.remove(fileId).then(() => {
			this.showAlert('fileRemoved');
		});
	}

	handlePlayerIconUpload(files) {
		if (this.state.currentUser.UserPhoto) {
			UserPhotoService.remove(this.state.currentUser.UserPhoto.id).then(() => {
				this.createUserPhoto(files);
			}).catch((error) => {
				console.log(error);
				this.createUserPhoto(files);
			});
		} else {
			this.createUserPhoto(files);
		}
	}

	handlePhotoStreamUpload(files) {
		this.uploadFiles(files, 'photoStream').then((responses) => {
			let promises = [];
			responses.forEach((response, i) => {
				let file = {
					'name': response.data.file.name,
					'size': response.data.file.size,
					'type': response.data.file.type,
					'identifier': 'photoStream',
					'UserId': this.state.currentUser.id,
					'locationUrl': response.data.file.locationUrl
				};
				promises.push(FileService.create(file));
			});
			axios.all(promises).then((files) => {
				let photos;
				files.forEach((file) => {
					photos = this.state.photoStream;
					photos.push(file);
				});
				this.setState({
					'fileUploadPhotoStream': [],
					'photoStream': photos
				});
				this.showAlert('uploadSuccess');
				this.props.resetForm('photoStreamUploadForm');
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

	pageModal(index, direction, e) {
		e.preventDefault();
		if (direction === 'forward') {
			index++;
		} else if (direction === 'backward') {
			index--;
		}
		if (index < 0) {
			index = this.state.photoStream.length - 1
		}
		if (index > this.state.photoStream.length - 1) {
			index = 0;
		}
		this.setState({
			'activeModal': `photoStream-${index}`
		});
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
			'fileRemoved': () => {
				this.props.addAlert({
					'title': 'Photo Deleted',
					'message': 'A photo was successfully deleted from Photo Stream.',
					'type': 'success',
					'delay': 3000
				});
			},
			'uploadSuccess': () => {
				this.props.addAlert({
					'title': 'Upload Success',
					'message': 'New files were successfully uploaded',
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

	toggleEdit(identifier, e) {
		if (e) {
			e.preventDefault();
		}
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

	toggleModal(name, e) {
		if (e) { e.preventDefault() };
		this.setState({
			'activeModal': this.state.activeModal !== name ? name : 'none'
		});
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
            <ViewWrapper headerImage="/images/Titles/Player_Dashboard.png" headerAlt="Player Dashboard">
				<div className="player-dashboard">
					<div className="row wrap-reverse">
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
						</div>
						<div className="small-12 medium-6 columns text-center">
							<h2 className="no_shadow">{ currentUser.firstName ? (currentUser.firstName + ' ' + currentUser.lastName) : 'Anonymous'} </h2>
							<div className="text-center">
								<h3 className="gold-label">RP Stash: <span><strong className="gold">{currentUser.rewardPoints || 0}</strong> Points</span></h3>
								<div className="flex-row-center push-top">
									<div className="profile-picture">
										<img src={this.getPlayerIcon.call(this, currentUser)} alt={currentUser.username} className="shadow"/>
										<Form name="playerIconForm" submitButton={false}>
											<FileUpload name="playerIcon" value={this.state.fileUploadIcon} handleFileUpload={this.handlePlayerIconUpload} accept="image/*" maxFiles={10} hideFileList={true}/>
										</Form>
									</div>
								</div>
							</div>
							<h1 className="push-top"><Link to={`/players/profile/${currentUser.username}`} className="username">{currentUser.username}</Link></h1>
							<div className="">
								<p><Link to={`/players/dashboard/change-password`}>Change Password?</Link></p>
							</div>
							<div className="row push-top-2x">
								<div className="small-12 columns text-center">
									<Link to="/players/dashboard/account-edit"><h3 className="button account-details">Edit Account Details</h3></Link>
								</div>
								<div className="small-12 columns text-center">
									<Link to="/subscribe"><h3 className="button secondary push-top">Become a BC Subscriber</h3></Link>
								</div>
							</div>
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Allies <Link to={`/players/profile/${currentUser.username}/ally-search`} className="right">View All</Link></h2>
							<div className="friend-list">
								{
									currentUser.Friends.map((friend, i) =>
									<span key={friend.id} className="icon-box">
										<Link to={`/players/profile/${friend.username}`}>
											<img className="icon" src={this.getPlayerIcon.call(this, friend)} />
											<span className="name-label">{friend.firstName} {friend.lastName}</span>
										</Link>
									</span>
									)
								}
							</div>
							{
								currentUser.Friends.length < 1 &&
								<h4 className="text-center">Search by player profile and click 'Add Ally' to send a ally request.</h4>
							}
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Achievements</h2>
							{
								currentUser.UserAchievements.length > 0 ?
								<div className="text-center achievements">
									{
										currentUser.UserAchievements.slice(0, 10).map((achievement, i) =>
											<span key={achievement.id} className="achievement">
												<div className="achievement-title">{achievement.title}</div>
												<div><img src={achievement.File ? `${achievement.File.locationUrl}100-${achievement.File.name}` : '/uploads/achievements/100-defaultAchievement.png'} alt={achievement.name} /></div>
												{
													<div className="achievement-description">
														<i className="fa fa-connectdevelop"></i> {achievement.description}
													</div>
												}
											</span>
										)
									}
								</div> :
								<h4 className="text-center">You have not yet been awarded any achievements.</h4>
							}
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Ranking <Link to="/ranking/search/all" className="right"><span className="fa fa-list-ol"></span> Leaderboards</Link></h2>
							<div className="small-12 columns">
								{
									currentUser.GameSystemRankings.length < 1 &&
									<h4 className="text-center">Submit game results to a Battle-Comm participating event/venue administrator to have your ranking submitted to the BC leaderboards.</h4>
								}
								{
									currentUser.GameSystemRankings.map((gameRanking, i) =>
									<div key={gameRanking.id} className="row">
										<h4><Link to={`/ranking/search/${gameRanking.GameSystemId}`}>{gameRanking.GameSystem.name}</Link>: {gameRanking.totalWins}/{gameRanking.totalLosses}/{gameRanking.totalDraws}</h4>
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
														<tr key={factionRanking.id} className="item">
															<td><Link to={`/ranking/search/${gameRanking.GameSystemId}`} className="color-black">{gameRanking.GameSystem.name}</Link></td>
															<td><Link to={`/ranking/search/${gameRanking.GameSystemId}/${factionRanking.FactionId}`} className="color-black">{factionRanking.Faction.name}</Link></td>
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
							<h2>Photo Stream</h2>
							<Form name="photoStreamUploadForm" submitButton={false}>
								<FileUpload name="photoStream" value={this.state.fileUploadPhotoStream} handleFileUpload={this.handlePhotoStreamUpload} accept="image/*" maxFiles={50} hideFileList={true}/>
							</Form>
							<hr/>
							<div className="text-center">
								{
									this.state.photoStream.length > 0 ?
									<div className="photo-stream">
										{
											this.state.photoStream.map((photo, i) =>
												<div key={photo.id} className="photo-box">
													<a onClick={this.toggleModal.bind(this, `photoStream-${i}`)}><img src={`/uploads/players/${this.state.currentUser.id}/photoStream/${photo.name}`}/></a>
														<Modal name={`photoStream-${i}`} title={`${this.state.currentUser.username}'s Photo Stream`} modalIsOpen={this.state.activeModal === `photoStream-${i}`} handleClose={this.toggleModal.bind(this, `photoStream-${i}`)} showClose={true} showCancel={false} confirmText="Delete?" handleSubmit={this.deletePhoto.bind(this, photo.id, i)}>
															<img src={`/uploads/players/${this.state.currentUser.id}/photoStream/${photo.name}`}/>
															<div className="actions">
																<span className="fa fa-arrow-left" onClick={this.pageModal.bind(this, i, 'backward')}></span>
																<span className="fa fa-arrow-right" onClick={this.pageModal.bind(this, i, 'forward')}></span>
																</div>
														</Modal>
												</div>
											)
										}
									</div> :
									<h4>Upload photos from you dashboard to share your table-top experience with friends.</h4>
								}
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(PlayerDashboard));
