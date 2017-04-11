'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {UserActions} from '../../../library/authentication';
import {PaginationControls} from '../../../library/pagination';
import ViewWrapper from '../../ViewWrapper';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
    return {'users': state.users}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
        'searchUsers': UserActions.search
    }, dispatch)
};

class SearchUsersPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {},
			'searchQuery': ''
		}

		this.handleFilterReset = this.handleFilterReset.bind(this);
		this.handleOrderChange = this.handleOrderChange.bind(this);
		this.handlePageChange = this.handlePageChange.bind(this);
		this.handlePageSizeChange = this.handlePageSizeChange.bind(this);
		this.handleQueryChange = this.handleQueryChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Search Users";
		this.handlePageChange(1);
    }

	handleFilterReset() {
		this.setState({
			'pageSize': 20,
			'orderBy': 'updatedAt',
			'searchQuery': ''
		}, () => {
			this.handlePageChange(1);
		});
	}

	handleOrderChange(e) {
		this.setState({
			'orderBy': e.target.value
		}, () => {
			this.handlePageChange(1);
		});
	}

	handlePageChange(pageNumber = 1) {
        this.props.searchNewsPosts({'pageNumber': pageNumber, 'searchQuery': this.state.searchQuery, 'orderBy': this.state.orderBy, 'pageSize': this.state.pageSize}).then((pagination) => {
			this.setState({
				'pagination': pagination
			});
        });
    }

	handlePageSizeChange(e) {
		this.setState({
			'pageSize': e.target.value
		}, () => {
			this.handlePageChange(1);
		});
	}

	handleQueryChange(e) {
		if (timer) {
			clearTimeout(timer);
		}
		this.setState({
			'searchQuery': e.target.value
		}, () => {
			timer = setTimeout(() => {
				this.handlePageChange(1);
			}, 500);
		});
	}

    render() {
        return (
            <ViewWrapper>
				<div className="small-12 columns">
					<h1>Search Users</h1>
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
				</div>
                <div className="row">
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel">
							<div className="panel-title">
								Search Filter
							</div>
							<div className="panel-content">
								<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Begin typing to filter results"/>
							</div>
						</div>
						<div className="panel">
							<div className="panel-title">
								Order By
							</div>
							<div className="panel-content">
								<select name="orderBy" onChange={this.handleOrderChange} value={this.state.orderBy}>
									<option value="createdAt">Created Date</option>
									<option value="updatedAt">Last Updated</option>
									<option value="lastName">Lastname</option>
									<option value="email">E-mail</option>
								</select>
							</div>
						</div>
						<div className="panel">
							<div className="panel-title">
								Items Per Page
							</div>
							<div className="panel-content">
								<select name="pageSize" onChange={this.handlePageSizeChange} value={this.state.pageSize}>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>
							</div>
						</div>
						<div className="panel">
							<div className="panel-title">
								Reset Search Filters
							</div>
							<div className="panel-content">
								<button className="button error" onClick={this.handleFilterReset}><span className="fa fa-refresh"> </span>Reset</button>
							</div>
						</div>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<div className="form-group">
							<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Enter search terms to filter results"/>
							<button className="button" onClick={this.handlePageChange.bind(this, 1, this.state.searchQuery)}>Search!</button>
						</div>
						<hr/>
						<table>
							<thead>
								<tr>
									<th>Handle</th>
									<th>Full Name</th>
									<th>E-mail</th>
									<th>View/Edit</th>
								</tr>
							</thead>
							<tbody>
								{
									this.props.users.map((user, i) =>
										<tr key={i}>
											<td>{user.username}</td>
											<td>{user.lastName + ', ' + user.firstName}</td>
											<td>{user.email}</td>
											<td>
												<Link className="action-item" key="editUser" to={`/admin/players/edit/${user.id}`}>
													<span className="action">
														<i className="tip-icon fa fa-pencil"></i>
													</span>
													<span className="mobile-text">Edit</span>
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
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(SearchUsersPage);
