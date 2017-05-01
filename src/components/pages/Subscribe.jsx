'use strict';

import React from 'react';
import {Link} from 'react-router-dom';
import ViewWrapper from '../ViewWrapper';

export default class Subscribe extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Subscribe";
		console.log('WIP: Page not yet configured.');
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
