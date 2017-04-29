'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {PaginationControls} from '../../../library/pagination';
import ViewWrapper from '../../ViewWrapper';
import UserFriendService from '../../../services/UserFriendService';

let _timer;

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
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Allys";
		this.handlePageChange(1);
    }

	componentWillUnmount() {
		if (_timer) {
			clearTimeout(_timer);
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
		UserFriendService.search({
			'username': this.props.params.playerHandle,
			'pageSize': 10,
			'pageNumber': pageNumber
		}).then((response) => {
			this.setState({
				'friends': response.results,
				'pagination': response.pagination
			})
		});
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Player_Ally_Search.png" headerAlt="Player Ally Search">
				<div className="small-12 columns">
					<h2>{`${this.props.params.playerHandle}'s`} allies</h2>
					{
						this.state.friends.length > 0 ?
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
									this.state.friends.map((friend, i) =>
										<tr key={friend.id}>
											<td>{friend.username}</td>
											<td>{friend.lastName}, {friend.firstName}</td>
											<td>
												<Link className="action-item" to={`/players/profile/${friend.username}`}>
													<span className="mobile-text">View</span>
												</Link>
											</td>
											<td><Link className="action-item" to={`/players/profile/${friend.username}`}><img className="image-tiny" src={this.getPlayerIcon.call(this, friend)} /></Link>
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
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, null)(PlayerAllySearchPage);
