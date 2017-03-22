'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class AdminDashboardPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Sandbox | Admin Dashboard";
    }

    render() {
        return (
            <ViewWrapper>
                <div className="row">
                    <h1>Admin Dashboard</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
            </ViewWrapper>
        );
    }
}
