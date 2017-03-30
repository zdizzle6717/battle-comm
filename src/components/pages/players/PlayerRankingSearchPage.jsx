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

export default class PlayerRankingSearchPage extends React.Component {
    constructor() {
		super();

		this.state = {
			'pagination': {},
			'searchQuery': '',
			'searchBy': 'lastName'
		}

		this.handlePageChange = this.handlePageChange.bind(this);
		this.handleQueryChange = this.handleQueryChange.bind(this);
		this.handleSearchByChange = this.handleSearchByChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Ranking Search";
		this.handlePageChange(1);
    }

	handlePageChange(pageNumber) {
        this.props.searchManufacturers({'searchQuery': this.state.searchQuery, 'searchBy': this.state.searchBy, 'pageNumber': pageNumber, 'pageSize': 20}).then((pagination) => {
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
					<h1>Player Ranking Search</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
				</div>
				<div className="form-group">
					<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Enter search terms to filter results"/>
					<button className="button" onClick={this.handlePageChange.bind(this, 1, this.state.searchQuery)}>Search!</button>
				</div>
				<hr/>
				<div className="small-12 columns">
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Search Key</th>
								<th>Date Updated</th>
								<th>View/Edit</th>
							</tr>
						</thead>
						<tbody>
							{
								this.props.manufacturers.map((manufacturer, i) =>
									<tr key={i}>
										<td>{manufacturer.name}</td>
										<td>{manufacturer.description}</td>
										<td>{manufacturer.searchKey}</td>
										<td>{manufacturer.updated_at}</td>
										<td>
											<Link className="action-item" key="editManufacturer" to={`/admin/manufacturers/edit/${manufacturer.id}`}>
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
            </ViewWrapper>
        );
    }
}
