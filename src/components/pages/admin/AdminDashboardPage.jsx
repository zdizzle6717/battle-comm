'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class AdminDashboardPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Admin Dashboard";
    }

    render() {
        return (
            <ViewWrapper>
                <div className="row">
					<div className="small-12 columns">
						<h1>Admin Dashboard</h1>
	                    <p>
	                        <Link to="/">Go back to the main page</Link>
	                    </p>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}
