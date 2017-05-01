'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import ViewWrapper from '../../ViewWrapper';

class OrderSuccess extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Order Success";
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Order_Success.png" headerAlt="Order Success">
                <div className="row">
					<h3 className="text-center"><strong>Order Success!</strong> Check your e-mail for more details and shipping information.</h3>
                </div>
            </ViewWrapper>
        );
    }
}

export default withRouter(OrderSuccess);
