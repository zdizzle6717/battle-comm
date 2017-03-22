'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import Animation from 'react-addons-css-transition-group';
import {AlertActions} from '../../library/alerts';
import isEmpty from '../../library/utilities/isEmpty';

const mapStateToProps = (state) => {
    return {}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({}, dispatch);
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
                <div className="content-box-container">
                    <div className="box-6">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
                                <p className="indent">Find access to a worldwide community of dedicated table-top gamers and hobbyists as well as tools to promote your store, events, and gaming space to a worldwide community of dedicated table-top players. Earn system packs and a reward point vault for your future customers.</p>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                    <div className="box-6">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
                                <p className="indent">Benefit from tools to help you organize, promote, and execute your gaming event with the ability to create game schedules on the fly, change matches as demands require, post results (and rewards) in real time, and track scoring and stats, all from a friendly, manageable online dashboard.</p>
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
                <div className="content-box-container">
                    <div className="box-4">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
                                <h2 className="text-center">Twitter Stream</h2>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                    <div className="box-8">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
                                <h2 className="text-center">Featured Video</h2>
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
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(IndexPage);
