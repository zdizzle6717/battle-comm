'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class NewsPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | News";
    }

    render() {
        return (
            <ViewWrapper>
                <div className="row">
					<div className="small-12 columns">
						<h1>News</h1>
						<hr />
					</div>
                </div>
            </ViewWrapper>
        );
    }
}
