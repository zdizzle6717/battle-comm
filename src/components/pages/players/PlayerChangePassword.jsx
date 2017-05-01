'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import ViewWrapper from '../../ViewWrapper';

class PlayerChangePassword extends React.Component {
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

export default withRouter(PlayerChangePassword);
