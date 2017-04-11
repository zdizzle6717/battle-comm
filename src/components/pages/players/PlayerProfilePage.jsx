'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import PlayerService from '../../../services/PlayerService';

// TODO: Add function to check if players are already friends

const mapStateToProps = (state) => {
	return {
		'currentUser': state.user,
		'isAuthenticated': state.isAuthenticated
	}
}

export default class PlayerProfilePage extends React.Component {
    constructor() {
        super();

		this.state = {
			'player': {
				'Friends': [],
				'GameSystemRankings': []
			},
			'alreadyFriends': false

		}

		this.addFriend = this.addFriend.bind(this);
		this.removeFriend = this.removeFriend.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Profile";
		if (!this.props.params.playerHandle) {
			browserHistory.push(`/players/dashboard`);
		} else {
			PlayerService.getByUsername(this.props.params.playerHandle).then((player) => {
				this.setState({
					'player': player
				})
			});
		}

    }

	addFriend() {
		console.log(`Add user with id, ${this.state.player.id}, as a friend.`);
	}

	removeFriend() {
		console.log(`Remove user with id, ${this.state.player.id}, from friends list.`);
	}

	showAlert(selector) {
		const alerts = {
			'playerNotFound': () => {
				this.props.addAlert({
					'title': 'Player Not Found',
					'message': `No player found. Redirecting to you dashboard.`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
		let player = this.state.player;
		let isSamePlayer = this.state.player.id === this.props.currentUser;

        return (
            <ViewWrapper>
				<div className="player-profile">
					<div className="row">
						<div className="small-12 columns">
							<h1>Player Profile</h1>
							<hr />
						</div>
	                </div>
					<div className="row">
						<div className="small-12 medium-6 columns">
							<h2>Player Info</h2>
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
								<img src={`/uploads/players/${player.id}/playerIcon/${player.icon}`} alt="" className="profile-picture shadow"/>
							</div>
							<h1 className="username text-center">
								<span className="glyphicon glyphicon-user"></span> {player.username}
							</h1>
							{
								!isSamePlayer &&
								<div className="text-center">
									{
										this.state.alreadyFriends ?
										<p><a onClick={this.removeFriend}><i className="fa fa-minus"></i> Remove Alliance</a></p> :
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
											<img className="icon" src={`/uploads/players/${friend.id}/playerIcon/thumbs/${friend.icon}`} />
											<span className="name-label">{friend.firstName} {friend.lastName}</span>
										</Link>
									)
								}
							</div>
							{
								player.Friends.length < 1 &&
								<div className="text-center">
									<h5>Send an ally request to welcome this player to Battle-Comm!</h5>
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
							TODO: Add popup component and list of player images
							<div className="text-center">
								<h5>{player.username} has not uploaded any photos to their photostream</h5>
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
