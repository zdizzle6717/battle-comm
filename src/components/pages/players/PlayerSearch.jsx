'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import ViewWrapper from '../../ViewWrapper';
import {UserActions} from '../../../library/authentication';
import {PaginationControls} from '../../../library/pagination';

const mapStateToProps = (state) => {
	return {
		'players': state.users
	}
};

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'searchPlayers': UserActions.search
	}, dispatch);
}

let timer;

class PlayerSearch extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {},
			'searchQuery': '',
			'searchBy': 'username',
			'orderBy': 'username'
		}

		this.handlePageChange = this.handlePageChange.bind(this);
		this.handleQueryChange = this.handleQueryChange.bind(this);
		this.handleSearchByChange = this.handleSearchByChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Search";
		this.handlePageChange(1);
    }

	componentWillUnmount() {
		if (timer) {
			clearTimeout(timer);
		}
	}

	getPlayerIcon(player) {
		let userPhoto = player.UserPhoto;
		return userPhoto ? `/uploads/players/${player.id}/playerIcon/300-${player.UserPhoto.name}` : '/uploads/players/defaults/300-profile-icon-default.png';
	}

	handlePageChange(pageNumber = 1, e) {
		if (e && e.keyCode && e.keyCode !== 13) {
			return;
		}
        this.props.searchPlayers({'searchQuery': this.state.searchQuery, 'searchBy': this.state.searchBy, 'pageNumber': pageNumber, 'orderBy': this.state.orderBy, 'pageSize': 10}).then((pagination) => {
			this.setState({
				'pagination': pagination
			});
        });
    }

	handleQueryChange(e) {
		let searchQuery = e.target.value;
		if (timer) {
			clearTimeout(timer);
		}
		timer = setTimeout(() => {
			this.handlePageChange(1);
		}, 500);
		this.setState({
			'searchQuery': e.target.value
		});
	}

	handleSearchByChange(e) {
		this.setState({
			'searchBy': e.target.value
		}, () => {
			this.handlePageChange(1)
		});
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Player_Search.png" headerAlt="Player Search">
				<div className="row">
					<div className="small-12 medium-6 large-8 columns">
						<label>Search Query</label>
						<div className="form-group search-input">
							<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Enter search terms to filter results" onKeyUp={this.handlePageChange.bind(this, 1)}/>
							<span className="search-icon fa fa-search pointer" onClick={this.handlePageChange.bind(this, 1)}></span>
						</div>
					</div>
					<div className="small-12 medium-6 large-4 columns">
						<label>Search By</label>
						<div className="form-group inline">
							<select name="searchBy" value={this.state.searchBy} onChange={this.handleSearchByChange}>
								<option value='username'>Username</option>
								<option value='firstName'>First Name</option>
								<option value='lastName'>Last Name</option>
							</select>
							<button className="button" onClick={this.handlePageChange.bind(this, 1)}>Search!</button>
						</div>
					</div>
				</div>
				<hr/>
				<div className="small-12 columns">
					{
						this.props.players.length > 0 ?
						<table className="stack hover text-center">
							<thead>
								<tr>
									<th className="text-center">Handle</th>
									<th className="text-center">Full Name</th>
									<th className="text-center">Go To Profile</th>
									<th className="text-center">Player Icon</th>
								</tr>
							</thead>
							<tbody>
								{
									this.props.players.map((user, i) =>
										<tr key={user.id}>
											<td><Link className="action-item" to={`/players/profile/${user.username}`}>{user.username}</Link></td>
											<td>{user.firstName && user.lastName ? user.lastName + ', ' + user.firstName : 'anonymous'}
											</td>
											<td>
												<Link className="action-item" to={`/players/profile/${user.username}`}>
													<span className="mobile-text">View</span>
												</Link>
											</td>
											<td><Link className="action-item" to={`/players/profile/${user.username}`}><img src={this.getPlayerIcon.call(this, user)} className="image-tiny"/></Link>
											</td>
										</tr>
									)
								}
							</tbody>
						</table> :
						<h3 className="text-center">No results found for the selected search</h3>
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

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(PlayerSearch));
