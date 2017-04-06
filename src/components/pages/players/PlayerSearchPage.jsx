'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
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

class PlayerSearchPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {},
			'searchQuery': '',
			'searchBy': 'username'
		}

		this.getPlayerIcon = this.getPlayerIcon.bind(this);
		this.handlePageChange = this.handlePageChange.bind(this);
		this.handleQueryChange = this.handleQueryChange.bind(this);
		this.handleSearchByChange = this.handleSearchByChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Search";
		this.handlePageChange(1);
    }

	getPlayerIcon(user) {
		let fileName;
		user.Files.forEach((file) => {
			if (file.identifier === 'playerIcon') {
				fileName = file.name;
			}
		});
		return fileName ? `/uploads/players/${user.id}/playerIcon/thumbs/${fileName}` : '/uploads/players/profile_image_default.png';
	}

	handlePageChange(pageNumber, e) {
		if (e && e.keyCode && e.keyCode !== 13) {
			return;
		}
        this.props.searchPlayers({'searchQuery': this.state.searchQuery, 'searchBy': this.state.searchBy, 'pageNumber': pageNumber, 'pageSize': 20}).then((pagination) => {
			this.setState({
				'pagination': pagination
			});
        });
    }

	handleQueryChange(e) {
		this.setState({
			'searchQuery': e.target.value
		})
	}

	handleSearchByChange(e) {
		this.setState({
			'searchBy': e.target.value
		})
	}

    render() {
        return (
            <ViewWrapper>
                <div className="small-12 columns">
                    <h1>Player Search</h1>
                </div>
				<div className="small-12 medium-6 large-8 columns">
					<div className="form-group search-input">
						<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Enter search terms to filter results" onKeyUp={this.handlePageChange.bind(this, 1)}/>
						<span className="search-icon fa fa-search pointer" onClick={this.handlePageChange.bind(this, 1)}></span>
					</div>
				</div>
				<div className="small-12 medium-6 large-4 columns">
					<div className="form-group inline">
						<select name="searchBy" value={this.state.searchBy} onChange={this.handleSearchByChange}>
							<option value='username'>Username</option>
							<option value='firstName'>First Name</option>
							<option value='lastName'>Last Name</option>
						</select>
						<button className="button" onClick={this.handlePageChange.bind(this, 1)}>Search!</button>
					</div>
				</div>
				<hr/>
				<div className="small-12 columns">
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
									<tr key={i}>
										<td>{user.username}</td>
										<td>{user.firstName && user.lastName ? user.lastName + ', ' + user.firstName : 'anonymous'}
										</td>
										<td>
											<Link className="action-item" key="playerProfile" to={`/players/profile/${user.username}`}>
												<span className="mobile-text">View</span>
											</Link>
										</td>
										<td><Link className="action-item" key="playerProfile" to={`/players/profile/${user.username}`}><img src={`${this.getPlayerIcon(user)}`} className="image-tiny"/></Link>
										</td>
									</tr>
								)
							}
						</tbody>
					</table>
					<hr/>
					<div className="small-12 columns">
						<PaginationControls pageNumber={this.state.pagination.pageNumber} pageSize={this.state.pagination.pageSize} totalPages={this.state.pagination.totalPages} totalResults={this.state.pagination.totalResults} handlePageChange={this.handlePageChange.bind(this)}></PaginationControls>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PlayerSearchPage);
