'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class RewardPointPurchasePage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Purchase RP";
		console.log('WIP: Page not yet configured.');
		browserHistory.push('/');
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/title/Store.png" headerAlt="Store">
                <div className="row">
                    <h1>Purchase RP</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
            </ViewWrapper>
        );
    }
}
