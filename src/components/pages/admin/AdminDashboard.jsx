'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import BannerSlideManagement from '../../pieces/BannerSlideManagement';
import RewardPointPurchase from '../../pieces/RewardPointPurchase';
import RPDistributionManagement from '../../pieces/RPDistributionManagement';
import ViewWrapper from '../../ViewWrapper';
import AdminMenu from '../../pieces/AdminMenu';
import roleConfig from '../../../../roleConfig';
import createAccessControl from '../../../library/authentication/components/AccessControl';
const AccessControl = createAccessControl(roleConfig);

const mapStateToProps = (state) => {
	return {
		'currentUser': state.user,
		'forms': state.forms
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class AdminDashboard extends React.Component {
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
				</div>
				<AccessControl access={['eventAdmin']} element="div" customClass="row">
					<RewardPointPurchase user={this.props.currentUser} forms={this.props.forms}></RewardPointPurchase>
				</AccessControl>
				<hr/>
				<AccessControl access={['eventAdmin']} element="div" customClasses="row">
					<RPDistributionManagement user={this.props.currentUser} forms={this.props.forms}></RPDistributionManagement>
				</AccessControl>
				<hr/>
				<AccessControl access={['systemAdmin']} element="div" customClasses="row">
					<BannerSlideManagement></BannerSlideManagement>
				</AccessControl>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(AdminDashboard));
