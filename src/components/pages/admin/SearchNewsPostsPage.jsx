'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {PaginationControls} from '../../../library/pagination';
import {formatJSONDate} from '../../../library/utilities';
import ViewWrapper from '../../ViewWrapper';
import NewsPostActions from '../../../actions/NewsPostActions';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
    return {'newsPosts': state.newsPosts}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
        'searchNewsPosts': NewsPostActions.search
    }, dispatch)
};

let timer;

class SearchNewsPostsPage extends React.Component {
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
        document.title = "Battle-Comm | Search News Posts";
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
					<h1>Search News Posts</h1>
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
									<option value="author">Author</option>
									<option value="title">Title</option>
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
							<div className="panel-content">
								<button className="button black center" onClick={this.handleFilterReset}><span className="fa fa-refresh"> </span>Reset</button>
							</div>
						</div>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<table className="stack hover text-center">
							<thead>
								<tr>
									<th className="text-center">Title</th>
									<th className="text-center">Author</th>
									<th className="text-center">Date Updated</th>
									<th className="text-center">View/Edit</th>
								</tr>
							</thead>
							<tbody>
								{
									this.props.newsPosts.map((newsPost, i) =>
										<tr key={i}>
											<td>{newsPost.title}</td>
											<td>{newsPost.User.lastName + ', ' + newsPost.User.firstName}</td>
											<td>{formatJSONDate(newsPost.updatedAt)}</td>
											<td>
												<Link className="action-item" key="editNewsPost" to={`/admin/newsPosts/edit/${newsPost.id}`}>
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

export default connect(mapStateToProps, mapDispatchToProps)(SearchNewsPostsPage);
