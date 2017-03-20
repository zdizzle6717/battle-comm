'use strict';

import React from 'react';

export default class ViewWrapper extends React.Component {
	constructor() {
		super();
	}

	render() {
		return (
			<div className="content-view">
				{this.props.children}
			</div>
		)
	}
}

ViewWrapper.propTypes = {}

ViewWrapper.defaultProps = {}
