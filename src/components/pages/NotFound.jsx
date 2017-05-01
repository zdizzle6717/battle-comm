'use strict';

import React from 'react';
import render from 'react-dom';
import {Link} from 'react-router-dom';
import {Status} from '../../library/routing';
import ViewWrapper from '../ViewWrapper';

export default class NotFound extends React.Component {
	constructor() {
		super();
	}

	componentWillMount() {
		const { history, location, match } = this.props;
	}

	componentDidMount() {
		document.title = "Battle-Comm | Page Not Found";
	}

	render() {
		return (
			<Status code={404}>
				<ViewWrapper headerImage="/images/Titles/Page_Not_Found.png" headerAlt="Page Not Found">
	                <div className="not-found">
	                    <h1>404 | Page not found</h1>
	                    <h2>This is not the page you are looking for.</h2>
	                    <p>
	                        <Link to="/">Go back to the main page</Link>
	                    </p>
	                </div>
	            </ViewWrapper>
			</Status>
		)
	}
}
