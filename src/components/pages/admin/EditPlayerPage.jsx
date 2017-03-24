'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class EditPlayerPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Edit";
    }

    render() {
        return (
            <ViewWrapper>
                <div className="row">
                    <h1>Player Edit</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
            </ViewWrapper>
        );
    }
}