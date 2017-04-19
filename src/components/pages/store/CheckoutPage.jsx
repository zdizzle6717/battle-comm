'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';

export default class CheckoutPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Checkout";
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/title/Checkout.png" headerAlt="Checkout">
                <div className="row">
                    <h1>Checkout</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
            </ViewWrapper>
        );
    }
}
