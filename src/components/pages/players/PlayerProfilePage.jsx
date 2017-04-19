'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import Modal from '../../../library/Modal';
import ViewWrapper from '../../ViewWrapper';
import PlayerService from '../../../services/PlayerService';
import UserFriendService from '../../../services/UserFriendService';
import UserNotificationService from '../../../services/UserNotificationService';

// TODO: Add function to check if players are already friends

const mapStateToProps = (state) => {
	return {
		'currentUser': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class PlayerProfilePage extends React.Component {
    constructor() {
        super();

		this.state = {
			'activeModal': 'none',
			'alreadyFriends': false,
			'photoStream': [],
			'player': {
				'Friends': [],
				'GameSystemRankings': [],
				'Files': []
			}
		}

		this.addFriend = this.addFriend.bind(this);
		this.removeFriend = this.removeFriend.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

	addFriend() {
		let currentUser = this.props.currentUser;
		UserNotificationService.create({
			'UserId': this.state.player.id,
			'type': 'allyRequestReceived',
			'fromId': currentUser.id,
			'fromUsername': currentUser.username,
			'fromName': currentUser.firstName && currentUser.lastName ? currentUser.firstName + ' ' + currentUser.lastName : 'anonymous'
		}).then(() => {
			this.showAlert('allyRequestSent');
		}).catch((error) => {
			if (error.message == 'Request already sent') {
				this.showAlert('allyAlreadyRequestSent');
			}
		});
	}

    componentDidMount() {
        document.title = "Battle-Comm | Player Profile";
		if (!this.props.params.playerHandle) {
			browserHistory.push(`/players/dashboard`);
		} else {
			this.getCurrentPlayer();
		}
    }

	getCurrentPlayer() {
		PlayerService.getByUsername(this.props.params.playerHandle).then((player) => {
			let alreadyFriends = player.Friends.some((friend) => {
				return friend.id === this.props.currentUser.id;
			});
			let photoStream = player.Files.filter((file) => file.identifier === 'photoStream');
			this.setState({
				'alreadyFriends': alreadyFriends,
				'photoStream': photoStream,
				'player': player
			});
		});
	}

	getPlayerIcon(player) {
		let userPhoto = player.UserPhoto;
		return userPhoto ? `/uploads/players/${player.id}/playerIcon/300-${player.UserPhoto.name}` : '/uploads/players/defaults/profile-icon-default.png';
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

	removeFriend() {
		UserFriendService.remove(this.props.currentUser.id, this.state.player.id).then(() => {
			this.setState({
				'alreadyFriends': false
			})
			this.getCurrentPlayer();
			this.showAlert('allianceBroken');
		});
	}

	showAlert(selector) {
		const alerts = {
			'allianceBroken': () => {
				this.props.addAlert({
					'title': 'Alliance Broken',
					'message': `You have broken your alliance with ${this.state.player.username}.`,
					'type': 'info',
					'delay': 3000
				});
			},
			'allyRequestSent': () => {
				this.props.addAlert({
					'title': 'Ally Request Sent',
					'message': `An ally request has been sent to ${this.state.player.username}.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'allyAlreadyRequestSent': () => {
				this.props.addAlert({
					'title': 'Request Already sent',
					'message': `An ally request has already been sent.`,
					'type': 'error',
					'delay': 3000
				});
			},
			'playerNotFound': () => {
				this.props.addAlert({
					'title': 'Player Not Found',
					'message': `No player found. Redirecting to you dashboard.`,
					'type': 'error',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

	toggleModal(name, e) {
		if (e) { e.preventDefault() };
		this.setState({
			'activeModal': this.state.activeModal !== name ? name : 'none'
		});
	}

    render() {
		let player = this.state.player;
		let isSamePlayer = this.state.player.id === this.props.currentUser.id;

        return (
            <ViewWrapper headerImage="/images/Titles/Player_Profile.png" headerAlt="Player Profile">
				<div className="player-profile">
					<div className="row">
						<div className="small-12 medium-6 columns">
							<h2 className="text-center">Player Info</h2>
							{
								player.bio ?
								<h3 className="user-bio push-bottom-2x">{player.bio}</h3> :
								<h3 className="user-bio push-bottom-2x">This player has not yet updaed their bio.</h3>
							}
							<div className="social-links push-bottom text-center">
								{
									player.facebook &&
									<a href={player.facebook} className="push-right push-left" target="_blank"><span className="fa fa-facebook"></span></a>
								}
								{
									player.twitter &&
									<a href={player.twitter} className="push-right push-left" target="_blank"><span className="fa fa-twitter"></span></a>
								}
								{
									player.instagram &&
									<a href={player.instagram} className="push-right push-left" target="_blank"><span className="fa fa-instagram"></span></a>
								}
								{
									player.twitch &&
									<a href={player.twitch} className="push-right push-left" target="_blank"><span className="fa fa-twitch"></span></a>
								}
								{
									player.googlePlus &&
									<a href={player.googlePlus} className="push-right push-left" target="_blank"><span className="fa fa-google-plus"></span></a>
								}
								{
									player.website &&
									<a href={player.website} className="push-right push-left" target="_blank"><span className="fa fa-globe"></span></a>
								}
							</div>
						</div>
						<div className="small-12 medium-6 columns">
							{
								player.firstName ?
								<h2 className="text-center">{player.firstName} {player.lastName}</h2> :
								<h2 className="text-center">Anonymous</h2>
							}
							<div className="text-center">
								<br/>
								<img src={this.getPlayerIcon.call(this, player)} alt={player.username} className="shadow"/>
							</div>
							<h1 className="username text-center">
								<span className="glyphicon glyphicon-user"></span> {player.username}
							</h1>
							{
								!isSamePlayer &&
								<div className="text-center">
									{
										this.state.alreadyFriends ?
										<p><a onClick={this.removeFriend}><i className="fa fa-minus"></i> Break Alliance</a></p> :
										<p><a onClick={this.addFriend}><i className="fa fa-plus"></i> Send Ally Request</a></p>
									}
								</div>
							}
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Allies <Link key="allyList" to={`/players/profile/${player.username}/ally-search`} className="right">View All</Link></h2>
							<div className="friend-list">
								{
									player.Friends.map((friend, i) =>
										<Link key={i} to={`/players/profile/${friend.username}`} className="icon-box">
											<img className="icon" src={this.getPlayerIcon.call(this, player)} />
											<span className="name-label">{friend.firstName} {friend.lastName}</span>
										</Link>
									)
								}
							</div>
							{
								player.Friends.length < 1 &&
								<div className="text-center">
									<h6>Send an ally request to welcome this player to Battle-Comm!</h6>
								</div>
							}
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Achievements</h2>
							<h3 className="text-center">This player has not yet been awarded any achievements.</h3>
						</div>
					</div>
					<div className="row">
						<div className="small-12 columns">
							<h2>Player Ranking <Link key="playerRanking" to="ranking/search/all" className="right"><span className="fa fa-list-ol"></span> Leaderboards</Link></h2>
							<div className="small-12 columns">
								{
									player.GameSystemRankings.length < 1 &&
									<h3 className="text-center">{player.username} has not submitted any game results to the BC leaderboards</h3>
								}
								{
									player.GameSystemRankings.map((gameRanking, i) =>
									<div key={i} className="row">
										<h4><Link key={`gameSystemRanking-${i}`} to={`/ranking/search/${gameRanking.GameSystemId}`}>{gameRanking.GameSystem.name}</Link>: {gameRanking.totalWins}/{gameRanking.totalLosses}/{gameRanking.totalDraws}</h4>
										<table className="search-results stack hover text-center">
											<thead>
												<tr>
													<th className="text-center">Game System</th>
													<th className="text-center">Faction</th>
													<th className="text-center">Ranking W/L/D</th>
													<th className="text-center">Point Value</th>
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
							<h2>Photostream</h2>
								<div className="text-center">
									{
										this.state.photoStream.length > 0 ?
										<div className="photo-stream">
											{
												this.state.photoStream.map((photo, i) =>
													<div key={i} className="photo-box">
														<a onClick={this.toggleModal.bind(this, `photoStream-${i}`)}><img src={`/uploads/players/${player.id}/photoStream/${photo.name}`}/></a>
															<Modal name={`photoStream-${i}`} title={`${player.username}'s Photo Stream`} modalIsOpen={this.state.activeModal === `photoStream-${i}`} handleClose={this.toggleModal.bind(this, `photoStream-${i}`)} showClose={true} showFooter={false}>
																<img src={`/uploads/players/${player.id}/photoStream/${photo.name}`}/>
																<div className="actions">
																	<span className="fa fa-arrow-left" onClick={this.pageModal.bind(this, i, 'backward')}></span>
																	<span className="fa fa-arrow-right" onClick={this.pageModal.bind(this, i, 'forward')}></span>
																	</div>
															</Modal>
													</div>
												)
											}
										</div> :
										<h5>This player has not yet uploaded photos to their profile.</h5>
									}
								</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PlayerProfilePage);
