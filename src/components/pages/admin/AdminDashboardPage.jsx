'use strict';

import React from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import BannerSlideManager from '../../pieces/BannerSlideManager';
import ViewWrapper from '../../ViewWrapper';
import AdminMenu from '../../pieces/AdminMenu';
import roleConfig from '../../../../roleConfig';
import createAccessControl from '../../../library/authentication/components/AccessControl';
const AccessControl = createAccessControl(roleConfig);

const mapStateToProps = (state) => {
	return {
		'currentUser': state.user
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class AdminDashboardPage extends React.Component {
    constructor() {
        super();

		this.state = {}
    }

    componentDidMount() {
        document.title = "Battle-Comm | Admin Dashboard";
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Admin_Dashboard.png" headerAlt="Admin Dashboard">
                <div className="row">
					<div className="small-12 columns">
						<hr/>
						<AdminMenu></AdminMenu>
						<hr/>
					</div>
					<AccessControl access={["systemAdmin"]}>
						<BannerSlideManager></BannerSlideManager>
					</AccessControl>
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(AdminDashboardPage);
