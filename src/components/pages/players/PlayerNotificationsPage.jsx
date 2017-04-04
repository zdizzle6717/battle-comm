'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class PlayerNotificationsPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Notifications";
    }

    render() {
        return (
            <ViewWrapper>
                <div className="row">
					<div className="small-12 columns">
						<h1>Player Notifications</h1>
					</div>
                </div>
                <div className="row">
					<div className="small-12 medium-6 columns">
						<h2>Notifications</h2>
					</div>
					<div className="small-12 medium-6 columns">
						<h2>Messages</h2>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}
