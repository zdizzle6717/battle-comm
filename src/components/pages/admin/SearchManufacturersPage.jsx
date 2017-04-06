'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {PaginationControls} from '../../../library/pagination';
import ViewWrapper from '../../ViewWrapper';
import ManufacturerActions from '../../../actions/ManufacturerActions';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
    return {'manufacturers': state.manufacturers}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
        'searchManufacturers': ManufacturerActions.search
    }, dispatch)
};

class SearchManufacturersPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {},
			'searchQuery': ''
		}

		this.handlePageChange = this.handlePageChange.bind(this);
		this.handleQueryChange = this.handleQueryChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Search Manufacturers";
		this.handlePageChange(1);
    }

	handlePageChange(pageNumber) {
        this.props.searchManufacturers({'searchQuery': this.state.searchQuery, 'pageNumber': pageNumber, 'pageSize': 20}).then((pagination) => {
			this.setState({
				'pagination': pagination
			});
        });
    }

	handleQueryChange(e) {
		this.setState({
			'searchQuery': e.target.value
		});
	}

    render() {
        return (
            <ViewWrapper>
				<div className="small-12 columns">
					<h1>Search Manufacturers</h1>
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
				</div>
                <div className="row">
					<div className="small-12 medium-4 large-3 columns">
						Filter Controls
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
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(SearchManufacturersPage);
