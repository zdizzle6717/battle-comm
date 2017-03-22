'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import Animation from 'react-addons-css-transition-group';
import {AlertActions} from '../../library/alerts';
import isEmpty from '../../library/utilities/isEmpty';
import ViewWrapper from '../ViewWrapper';

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
			<ViewWrapper>
				<div className="content-view">
					<div className="content-box-container">
						<div className="box-12">
							<div className="box-top">
								<div className="box-corner-tl"></div>
								<div className="box-bar-top"></div>
								<div className="box-corner-tr"></div>
							</div>
							<div className="box-middle">
								<div className="box-bar-left"></div>
								<div className="box-content">
									<h2 className="text-center">Banner</h2>
								</div>
								<div className="box-bar-right"></div>
							</div>
							<div className="box-bottom">
								<div className="box-corner-bl"></div>
								<div className="box-bar-bottom"></div>
								<div className="box-corner-br"></div>
							</div>
						</div>
					</div>
				</div>
			</ViewWrapper>
	    );
	}
}

export default connect(mapStateToProps, mapDispatchToProps)(IndexPage);
