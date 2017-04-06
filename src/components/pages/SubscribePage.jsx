'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import ViewWrapper from '../ViewWrapper';

export default class SubscribePage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Subscribe";
		console.log('WIP: Page not yet configured.');
		browserHistory.push('/');
    }

    render() {
        return (
            <ViewWrapper>
                <div className="row">
                    <h1>Subscribe</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
            </ViewWrapper>
        );
    }
}
