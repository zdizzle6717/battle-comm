'use strict';

import React from 'react';

export default class ViewWrapper extends React.Component {
	constructor() {
		super();
	}

	render() {
		return (
			<div className="content-view">
				{
					this.props.container === 'default' &&
					<div className="content-box-container">
						<div className="box-12">
							<div className="box-top">
								<div className="box-corner-tl"></div>
								<div className="box-bar-top"><div className="bar"></div></div>
								<div className="box-corner-tr"></div>
							</div>
							<div className="box-middle">
								<div className="box-bar-left"></div>
								<div className="box-content">
									{this.props.children}
								</div>
								<div className="box-bar-right"></div>
							</div>
							<div className="box-bottom">
								<div className="box-corner-bl"></div>
								<div className="box-bar-bottom"><div className="bar"></div></div>
								<div className="box-corner-br"></div>
							</div>
						</div>
					</div>
				}
			</div>
		)
	}
}

ViewWrapper.propTypes = {
	'container': React.PropTypes.string
}

ViewWrapper.defaultProps = {
	'container': 'default'
}
