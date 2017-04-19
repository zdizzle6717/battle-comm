'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import UserFriendService from '../../../services/UserFriendService';

let searchTimer;

const mapStateToProps = (state) => {
	return {
		'currentUser': state.user
	}
};

class PlayerAllySearchPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'friends': [],
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
        document.title = "Battle-Comm | Player Allys";
		this.handlePageChange(1);
    }

	getPlayerIcon(player) {
		let userPhoto = player.UserPhoto;
		return userPhoto ? `/uploads/players/${player.id}/playerIcon/300-${player.UserPhoto.name}` : '/uploads/players/defaults/300-profile-icon-default.png';
	}

	handlePageChange(pageNumber = 1, e) {
		if (e && e.keyCode && e.keyCode !== 13) {
			return;
		}
		UserFriendService.searchByUserId({
			'UserId': this.props.currentUser.id,
			'pageSize': 20,
			'pageNumber': pageNumber,
			'searchBy': this.state.searchBy,
			'searchQuery': this.state.searchQuery,
			'orderBy': this.state.orderBy
		}).then((response) => {
			this.setState({
				'friends': response.results,
				'pagination': response.pagination
			})
		});
	}

	handleQueryChange(e) {
		let searchQuery = e.target.value;
		if (searchTimer) {
			clearTimeout(searchTimer);
		}
		searchTimer = setTimeout(() => {
			this.handlePageChange(1);
		}, 500);
		this.setState({
			'searchQuery': searchQuery
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
            <ViewWrapper> headerImage="/images/Titles/Player_Ally_Search.png" headerAlt="Player Ally Search"
				<div className="small-12 columns">
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
							<div className="form-group">
								<select name="searchBy" value={this.state.searchBy} onChange={this.handleSearchByChange}>
									<option value='username'>Username</option>
									<option value='email'>E-mail</option>
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
							this.state.friends.length > 0 ?
							<table className="stack hover text-center">
								<thead>
									<tr>
										<th>Player Icon</th>
										<th>Handle</th>
										<th>Full Name</th>
										<th>Go To Profile</th>
									</tr>
								</thead>
								<tbody>
									{
										this.state.friends.map((friend, i) =>
											<tr key={i}>
												<td><Link className="action-item" key="playerProfile" to={`/players/profile/${friend.username}`}><img src={this.getPlayerIcon.call(this, friend)} /></Link>
												</td>
												<td>{friend.username}</td>
												<td>{friend.lastName}, {friend.firstName}</td>
												<td>
													<Link className="action-item" key="playerProfile" to={`/players/profile/${friend.username}`}>
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
							<h3 className="text-center">No allies found with the supplied search criteria</h3>
						}
						<hr/>
						<div className="small-12 columns">
							<PaginationControls pageNumber={this.state.pagination.pageNumber} pageSize={this.state.pagination.pageSize} totalPages={this.state.pagination.totalPages} totalResults={this.state.pagination.totalResults} handlePageChange={this.handlePageChange.bind(this)}></PaginationControls>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, null)(PlayerAllySearchPage);
