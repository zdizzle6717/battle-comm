'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import GameSystemActions from '../../../actions/GameSystemActions';
import RankingService from '../../../services/RankingService';

const mapStateToProps = (state) => {
	return {
		'factions': state.factions,
		'gameSystems': state.gameSystems
	}
}

const mapDispatchToProps = (dispatch) => {
	bindActionCreators({
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
		this.handleQueryChange = this.handleQueryChange.bind(this);
		this.handleOrderByChange = this.handleOrderByChange.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Ranking Search";
		if (!this.props.params.gameSystemId) {
			this.showAlert('gameSystemNotFound');
			// TODO: Return to previous page (Build a library for storing this?)
			browserHistory.push('/');
		} else {
			this.props.getGameSystems();
		}

		if (this.props.params.gameSystemId === 'all') {
			// TODO: Search all player ranking (might need a new endpoint)
			// OR: Don't search, display select options for gameSystem/Faction
		} else {
			GameSystemService.get(this.props.params.gameSystemId).then((gameSystem) => {
				this.setState({
					'selectedGameSystem': gameSystem
				});
			});
			this.handlePageChange(1);
		}
    }

	handleFactionChange(e) {
		let factionId = e.target.value;
		browserHistory.push(`/players/ranking/search/${this.props.params.gameSystemId}/${factionId}`);
	}

	handleGameSystemChange(e) {
		let gameSystemId = e.target.value;
		let goToUrl = this.props.params.factionId ? `/players/ranking/search/${gameSystemId}/${this.props.params.factionId}` : `/players/ranking/search/${gameSystemId}`;
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
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
				</div>
				<div className="row">
					<div className="small-12 medium-6 columns">
						<div className="form-group">
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
							<select name="factionId" value={this.props.params.factionId || ''} onChange={this.handleFactionChange}>
								<option value="">--Select--</option>
								{
									this.selectedGameSystem.Factions.map((faction, i) =>
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
						<table>
							<thead>
								<tr>
									<th>Username</th>
									<th>Total Wins</th>
									<th>Total Draws</th>
									<th>Total Losses</th>
									<th>Point Value</th>
									<th>View Profile</th>
								</tr>
							</thead>
							<tbody>
								{
									this.state.results.map((results, i) =>
										<tr key={i}>
											<td>{results.User.username}</td>
											<td>{results.totalWins}</td>
											<td>{results.totalDraws}</td>
											<td>{results.totalLosses}</td>
											<td>{results.pointValue}</td>
											<td>
												<Link className="action-item" key="playerProfile" to={`/players/profile/${results.User.username}`}>
													<span className="action">
														<i className="tip-icon fa fa-eye"></i>
													</span>
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

export default connect(mapStateToProps, mapDispatchToProps)(PlayerRankingSearchPage);
