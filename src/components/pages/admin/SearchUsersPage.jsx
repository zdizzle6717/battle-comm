'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class SearchUsersPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Sandbox | Search Users";
    }

    render() {
        return (
            <ViewWrapper>
                <div className="row">
                    <h1>Search Users</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
            </ViewWrapper>
        );
    }
}
