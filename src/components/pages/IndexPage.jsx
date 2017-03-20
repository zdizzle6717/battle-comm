'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import Animation from 'react-addons-css-transition-group';
import {AlertActions} from '../../library/alerts';
import isEmpty from '../../library/utilities/isEmpty';

const mapStateToProps = (state) => {
    return {
	}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
    }, dispatch);
};

class IndexPage extends React.Component {
    constructor() {
        super();

        this.state = {}
    }

	// Server side rendering - sends initial data
	// static fetchData(config) {
	// 	return config.store.dispatch(ProductOrderActions.getAll());
	// }

    render() {
		return (
			<div className="row">
				Hello React
			</div>
	    );
	}
}

export default connect(mapStateToProps, mapDispatchToProps)(IndexPage);
