'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {PaginationControls} from '../../../library/pagination';
import {formatJSONDate} from '../../../library/utilities';
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

let timer;

class SearchManufacturersPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {},
			'pageSize': 20,
			'orderBy': 'updatedAt',
			'searchQuery': ''
		}

		this.handleFilterReset = this.handleFilterReset.bind(this);
		this.handleOrderChange = this.handleOrderChange.bind(this);
		this.handlePageChange = this.handlePageChange.bind(this);
		this.handlePageSizeChange = this.handlePageSizeChange.bind(this);
		this.handleQueryChange = this.handleQueryChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Search Manufacturers";
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
        this.props.searchManufacturers({'pageNumber': pageNumber, 'searchQuery': this.state.searchQuery, 'orderBy': this.state.orderBy, 'pageSize': this.state.pageSize}).then((pagination) => {
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
            <ViewWrapper headerImage="/images/Titles/Manufacturer_Search.png" headerAlt="Manufacturer Search">
				<div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
				</div>
                <div className="row">
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Search Filter
							</div>
							<div className="panel-content">
								<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Begin typing to filter results"/>
							</div>
						</div>
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Order By
							</div>
							<div className="panel-content">
								<select name="orderBy" onChange={this.handleOrderChange} value={this.state.orderBy}>
									<option value="createdAt">Created Date</option>
									<option value="updatedAt">Last Updated</option>
									<option value="name">Name</option>
								</select>
							</div>
						</div>
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
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
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Reset Search Filters
							</div>
							<div className="panel-content text-center">
								<button className="button black small-12" onClick={this.handleFilterReset}><span className="fa fa-refresh"> </span>Reset</button>
							</div>
						</div>
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Add Manufacturer
							</div>
							<div className="panel-content text-center">
								<Link to="/admin/manufacturer/create" className="button black small-12"><span className="fa fa-plus"> </span> New Manufacturer</Link>
							</div>
						</div>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<table className="stack hover text-center">
							<thead>
								<tr>
									<th className="text-center">Name</th>
									<th className="text-center">Search Key</th>
									<th className="text-center">Date Updated</th>
									<th className="text-center">View/Edit</th>
								</tr>
							</thead>
							<tbody>
								{
									this.props.manufacturers.map((manufacturer, i) =>
										<tr key={i}>
											<td>{manufacturer.name}</td>
											<td>{manufacturer.searchKey}</td>
											<td>{formatJSONDate(manufacturer.updatedAt)}</td>
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
