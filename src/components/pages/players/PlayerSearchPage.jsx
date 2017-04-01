'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import {UserActions} from '../../../library/authentication';

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
			'searchBy': 'lastName'
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

	handlePageChange(pageNumber) {
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
					<button className="button" onClick={this.handlePageChange.bind(this, 1, this.state.searchQuery)}>Search!</button>
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
								this.props.users.map((user, i) =>
									<tr key={i}>
										<td><Link className="action-item" key="playerProfile" to={`/players/profile/${user.username}`}><img src={`${this.getPlayerIcon(user)}`} /></Link>
										</td>
										<td>{user.username}</td>
										<td>{user.lastName}, {user.firstName}</td>
										<td>
											<Link className="action-item" key="playerProfile" to={`/players/profile/${user.username}`}>
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
					<div className="small-12 columns">
						<PaginationControls pageNumber={this.state.pagination.pageNumber} pageSize={this.state.pagination.pageSize} totalPages={this.state.pagination.totalPages} totalResults={this.state.pagination.totalResults} handlePageChange={this.handlePageChange.bind(this)}></PaginationControls>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PlayerSearchPage);
