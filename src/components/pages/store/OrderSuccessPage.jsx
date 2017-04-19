'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class OrderSuccessPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Order Success";
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/title/Order_Success.png" headerAlt="Order Success">
                <div className="row">
                    <h1>Order Success</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
            </ViewWrapper>
        );
    }
}
