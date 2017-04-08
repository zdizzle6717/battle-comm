'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
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

class PlayerRankingSearchPage extends React.Component {
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
		if (!this.props.params.gameSystemId) {
			this.showAlert('gameSystemNotFound');
			// TODO: Return to previous page (Build a library for storing this?)
			browserHistory.push('/');
		}
		this.props.getGameSystems();

		if (this.props.params.gameSystemId === 'all') {
			// TODO: Search all player ranking (might need a new endpoint)
			// OR: Don't search, display select options for gameSystem/Faction
		} else {
			this.props.getGameSystem(this.props.params.gameSystemId).then((gameSystem) => {
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
		browserHistory.push(`/ranking/search/${this.props.params.gameSystemId}/${factionId}`);
	}

	handleGameSystemChange(e) {
		e.preventDefault();
		let gameSystemId = e.target.value;
		let goToUrl = `/ranking/search/${gameSystemId}`;
		browserHistory.push(goToUrl);
	}

	handleOrderByChange(e) {
		this.setState({
			'orderBy': e.target.value
		})
	}

	handlePageChange(pageNumber) {
		if (this.props.params.factionId) {
			RankingService.searchByFaction(this.props.params.factionId, {
				'pageNumber': pageNumber,
				'pageSize': 20
			}).then((response) => {
				this.setState({
					'pagination': response.pagination,
					'results': response.results
				});
			});
		} else {
			RankingService.searchByGameSystem(this.props.params.gameSystemId, {
				'pageNumber': pageNumber,
				'pageSize': 20
			}).then((response) => {
				this.setState({
					'pagination': response.pagination,
					'results': response.results
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
            <ViewWrapper>
				<div className="small-12 columns">
					<h1>Player Ranking Search</h1>
				</div>
				<hr/>
				<div className="row">
					<div className="small-12 medium-6 columns">
						<div className="form-group">
							<label>Game System</label>
							<select name="gameSystemId" value={this.props.params.gameSystemId || ''} onChange={this.handleGameSystemChange}>
								<option value="">--Select--</option>
								{
									this.props.gameSystems.map((gameSystem, i) =>
										<option key={i} value={gameSystem.id}>{gameSystem.name}</option>
									)
								}
							</select>
						</div>
					</div>
					<div className="small-12 medium-6 columns">
						<div className="form-group">
							<label>Faction</label>
							<select name="factionId" value={this.props.params.factionId || ''} onChange={this.handleFactionChange}>
								<option value="">All Factions</option>
								{
									this.state.selectedGameSystem.Factions.map((faction, i) =>
										<option key={i} value={faction.id}>{faction.name}</option>
									)
								}
							</select>
						</div>
					</div>
				</div>
				<hr/>
				<div className="small-12 columns">
					{
						this.state.results.length > 0 && this.props.params.gameSystemId !== 'all' ?
						<table className="stack hover text-center">
							<thead>
								<tr>
									<th className="text-center">Username</th>
									<th className="text-center">Total Wins</th>
									<th className="text-center">Total Draws</th>
									<th className="text-center">Total Losses</th>
									<th className="text-center">Point Value</th>
									<th className="text-center">View Profile</th>
								</tr>
							</thead>
							<tbody>
								{
									this.state.results.map((results, i) =>
										<tr key={i}>
											<td><Link className="action-item" key={i} to={`/players/profile/${this.props.params.factionId ? results.GameSystemRanking.User.username : results.User.username}`}>{this.props.params.factionId ? results.GameSystemRanking.User.username : results.User.username}</Link></td>
											<td>{results.totalWins}</td>
											<td>{results.totalDraws}</td>
											<td>{results.totalLosses}</td>
											<td>{results.pointValue}</td>
											<td>
												<Link className="action-item" key={i} to={`/players/profile/${this.props.params.factionId ? results.GameSystemRanking.User.username : results.User.username}`}>
													<span className="action">
														<i className="tip-icon fa fa-eye"></i>
													</span>
													<span className="mobile-text"> View</span>
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

export default connect(mapStateToProps, mapDispatchToProps)(PlayerRankingSearchPage);
