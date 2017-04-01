'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import PlayerService from '../../../services/PlayerService';

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
			'player': {},
			'searchQuery': '',
			'searchBy': 'username'
		}
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Allys";
		PlayerService.getByUsername(this.props.params.playerHandle).then((player) => {
			this.setState({
				'player': player,
				'friends': player.Friends
			})
		});
    }

	getPlayerIcon(friend) {
		let fileName;
		friend.Files.forEach((file) => {
			if (file.identifier === 'playerIcon') {
				fileName = file.name;
			}
		});
		return fileName ? `/uploads/players/${friend.id}/playerIcon/thumbs/${fileName}` : '/uploads/players/profile_image_default.png';
	}

	handleQueryChange(e) {
		let searchQuery = e.target.value;
		if (searchTimer) {
			clearTimeout(searchTimer);
		}
		searchTimer = setTimeout(() => {
			let newResults = this.state.friends;
			newResults = newResults.filter((result) => {
				return result[this.state.searchBy].indexOf(searchQuery) !== -1;
			});
			this.setState({
				'friends': newResults
			});
		}, 500);
		this.setState({
			'searchQuery': searchQuery
		});
	}

	handleSearchByChange(e) {
		let searchBy = e.target.value;
		let newResults = this.state.friends;
		newResults = newResults.filter((result) => {
			return result[searchBy].indexOf(this.state.searchQuery) !== -1;
		});
		this.setState({
			'friends': newResults,
			'searchBy': searchBy
		});
	}

    render() {
        return (
            <ViewWrapper>
                <div className="row">
                    <h1>Player Allys</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
				<div className="form-group">
					<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Enter search terms to filter results"/>
					<select name="searchBy" onChange={this.handleSearchByChange}>
						<option value='username'>Username</option>
						<option value='firstName'>First Name</option>
						<option value='lastName'>Last Name</option>
					</select>
				</div>
				<hr/>
				<div className="small-12 columns">
					<table>
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
								this.props.friends.map((friend, i) =>
									<tr key={i}>
										<td><Link className="action-item" key="playerProfile" to={`/players/profile/${friend.username}`}><img src={`${this.getPlayerIcon(friend)}`} /></Link>
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
					</table>
					<hr/>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, null)(PlayerAllySearchPage);
