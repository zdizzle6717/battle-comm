'use strict';

import React from 'react';
import PropTypes from 'prop-types';
import {PaginationControls} from '../../library/pagination';
import {uncamel} from '../../libary/utilities';

export default class PaginatedSearch extends React.Component {
	constructor() {
		super();

		this.state = {

		};
	}

	render() {
		<div>
			<table>
			    <tr>
			        {
						this.props.propertyList.map((prop, i) =>
							<th key={i}>{unCamel(prop)}</th>
						)
					}
			    </tr>
				{
					this.props.data((obj, i) =>
					<tr key={i}>
						{
							this.props.propertyList.map((prop, i) =>
								<td key={i}>{obj[prop]}</td>
							)
						}
						{
							this.props.linkColumns.map((column, i) =>
								<td key={i}>
									{
										column.name === 'edit' &&
										<Link className="action-item" key="i" to={column.to}>
											<span className="action">
												<i className="tip-icon fa fa-pencil"></i>
											</span>
											<span className="mobile-text">Edit</span>
										</Link>
									}
								</td>
							)
						}
					</tr>
					)
				}
			</table>
			<PaginationControls pageNumber={this.state.pageNumber} pageSize={this.state.pageSize} totalPages={this.state.totalPages} totalResults={this.state.totalResults} handlePageChange={this.handlePageChange}><PaginationControls>
		</div>

	}
}

PaginatedSearch.propTypes = {
	'propertyList': PropTypes.array,
	'data': PropTypes.object,
	'linkColumns': PropTypes.array
};

PaginatedSearch.defaultProps = {
};
