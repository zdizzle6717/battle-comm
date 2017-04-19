'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class PlayerChangePasswordPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Password Change";
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Change_Password.png" headerAlt="Change Password">
                <div className="row">
                </div>
            </ViewWrapper>
        );
    }
}
