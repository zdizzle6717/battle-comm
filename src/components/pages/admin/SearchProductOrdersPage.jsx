'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {PaginationControls} from '../../../library/pagination';
import ViewWrapper from '../../ViewWrapper';
import ProductOrderActions from '../../../actions/ProductOrderActions';


const mapStateToProps = (state) => {
    return {'productOrders': state.productOrders}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
        'searchProductOrders': ProductOrderActions.search
    }, dispatch)
};

class SearchProductOrdersPage extends React.Component {
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
        document.title = "Battle-Comm | Search Product Orders";
		this.handlePageChange(1);
    }

	handlePageChange(pageNumber, searchQuery = '') {
        this.props.searchProductOrders({'searchQuery': this.state.searchQuery, 'pageNumber': pageNumber, 'pageSize': 20}).then((pagination) => {
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

    render() {
        return (
            <ViewWrapper>
				<div className="small-12 columns">
					<h1>Search Product Orders</h1>
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
									<th>Id</th>
									<th>Order Date</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Total (RP)</th>
									<th>View/Edit</th>
								</tr>
							</thead>
							<tbody>
								{
									this.props.productOrders.map((productOrder, i) =>
										<tr key={i}>
											<td>{productOrder.id}</td>
											<td>{productOrder.created_at}</td>
											<td>{productOrder.customerEmail}</td>
											<td>{productOrder.customerPhone}</td>
											<td>{productOrder.orderTotal}</td>
											<td>
												<Link className="action-item" key="editProductOrder" to={`/admin/productOrders/edit/${productOrder.id}`}>
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

export default connect(mapStateToProps, mapDispatchToProps)(SearchProductOrdersPage);
