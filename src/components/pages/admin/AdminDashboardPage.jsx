'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import AdminMenu from '../../pieces/AdminMenu';

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
						<hr/>
						<AdminMenu></AdminMenu>
						<hr/>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}
