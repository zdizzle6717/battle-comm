'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import ViewWrapper from '../../ViewWrapper';
import GameSystemActions from '../../../actions/GameSystemActions';
import RankingService from '../../../services/RankingService';
import {PaginationControls} from '../../../library/pagination';

const mapStateToProps = (state) => {
	return {
		'factions': state.factions,
		'gameSystems': state.gameSystems
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'getGameSystem': GameSystemActions.get,
		'getGameSystems': GameSystemActions.getAll
	}, dispatch);
}

class PlayerRankingSearch extends React.Component {
    constructor() {
		super();

		this.state = {
			'pagination': {},
			'results': [],
			'searchQuery': '',
			'selectedGameSystem': {
				'Factions': []
			},
			'orderBy': ''
		}

		this.handleFactionChange = this.handleFactionChange.bind(this);
		this.handleGameSystemChange = this.handleGameSystemChange.bind(this);
		this.handlePageChange = this.handlePageChange.bind(this);
		this.handleOrderByChange = this.handleOrderByChange.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Ranking Search";
		if (!this.props.match.params.gameSystemId) {
			this.showAlert('gameSystemNotFound');
			// TODO: Return to previous page (Build a library for storing this?)
			this.props.history.push('/');
		}
		this.props.getGameSystems();

		if (this.props.match.params.gameSystemId === 'all') {
		} else {
			this.props.getGameSystem(this.props.match.params.gameSystemId).then((gameSystem) => {
				this.setState({
					'selectedGameSystem': gameSystem
				});
			});
			this.handlePageChange(1);
		}
    }

	handleFactionChange(e) {
		e.preventDefault();
		let factionId = e.target.value;
		this.props.history.push(`/ranking/search/${this.props.match.params.gameSystemId}/${factionId}`);
	}

	handleGameSystemChange(e) {
		e.preventDefault();
		let gameSystemId = e.target.value;
		let goToUrl = `/ranking/search/${gameSystemId}`;
		this.props.history.push(goToUrl);
	}

	handleOrderByChange(e) {
		this.setState({
			'orderBy': e.target.value
		})
	}

	handlePageChange(pageNumber) {
		if (this.props.match.params.factionId) {
			RankingService.searchByFaction(this.props.match.params.factionId, {
				'pageNumber': pageNumber,
				'pageSize': 20
			}).then((response) => {
				this.setState({
					'pagination': response.pagination,
					'results': response.results.filter((result) => result.GameSystemRanking.User)
				});
			});
		} else {
			RankingService.searchByGameSystem(this.props.match.params.gameSystemId, {
				'pageNumber': pageNumber,
				'pageSize': 20
			}).then((response) => {
				this.setState({
					'pagination': response.pagination,
					'results': response.results.filter((result) => result.User)
				});
			});
		}
    }

	showAlert(selector) {
		const alerts = {
			'gameSystemNotFound': () => {
				this.props.addAlert({
					'title': 'New Game System Found',
					'message': `No game system found with the supplied id`,
					'type': 'error',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Player_Ranking_Search.png" headerAlt="Player Ranking Search">
				<div className="row">
					<div className="small-12 medium-6 columns">
						<div className="form-group">
							<label>Game System</label>
							<select name="gameSystemId" value={this.props.match.params.gameSystemId || ''} onChange={this.handleGameSystemChange}>
								<option value="">--Select--</option>
								{
									this.props.gameSystems.map((gameSystem, i) =>
										<option key={gameSystem.id} value={gameSystem.id}>{gameSystem.name}</option>
									)
								}
							</select>
						</div>
					</div>
					<div className="small-12 medium-6 columns">
						<div className="form-group">
							<label>Faction</label>
							<select name="factionId" value={this.props.match.params.factionId || ''} onChange={this.handleFactionChange}>
								<option value="">All Factions</option>
								{
									this.state.selectedGameSystem.Factions.map((faction, i) =>
										<option key={faction.id} value={faction.id}>{faction.name}</option>
									)
								}
							</select>
						</div>
					</div>
				</div>
				<hr/>
				<div className="small-12 columns">
					{
						this.state.results.length > 0 && this.props.match.params.gameSystemId !== 'all' ?
						<table className="stack hover text-center">
							<thead>
								<tr>
									<th className="text-center">Username</th>
									<th className="text-center">Total Wins</th>
									<th className="text-center">Total Losses</th>
										<th className="text-center">Total Draws</th>
									<th className="text-center">Point Value</th>
									<th className="text-center">View Profile</th>
								</tr>
							</thead>
							<tbody>
								{
									this.state.results.map((ranking, i) =>
										<tr key={ranking.id}>
											<td><strong>Username: </strong><Link className="action-item" to={`/players/profile/${this.props.match.params.factionId ? ranking.GameSystemRanking.User.username : ranking.User.username}`}>{this.props.match.params.factionId ? ranking.GameSystemRanking.User.username : ranking.User.username}</Link></td>
											<td><strong>Total Wins: </strong>{ranking.totalWins}</td>
											<td><strong>Total Losses: </strong>{ranking.totalLosses}</td>
											<td><strong>Total Draws: </strong>{ranking.totalDraws}</td>
											<td><strong>PointValue: </strong>{ranking.pointValue}</td>
											<td><strong>Profile: </strong>
												<Link className="action-item" to={`/players/profile/${this.props.match.params.factionId ? ranking.GameSystemRanking.User.username : ranking.User.username}`}>
													<span className="mobile-text">View</span>
												</Link>
											</td>
										</tr>
									)
								}
							</tbody>
						</table> :
						<h3>No results found with the selected options. Choose a <strong>Game System</strong> and/or <strong>Faction</strong> to display new ranking search results.</h3>
					}
					<hr/>
					<div className="small-12 columns">
						<PaginationControls pageNumber={this.state.pagination.pageNumber} pageSize={this.state.pagination.pageSize} totalPages={this.state.pagination.totalPages} totalResults={this.state.pagination.totalResults} handlePageChange={this.handlePageChange.bind(this)}></PaginationControls>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(PlayerRankingSearch));
