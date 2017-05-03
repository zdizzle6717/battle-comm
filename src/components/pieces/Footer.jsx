'use strict';

import React from 'react';
import classNames from 'classnames';
import {CSSTransitionGroup as Animation} from 'react-transition-group';
import Modal from '../../library/modal';

export default class Footer extends React.Component {
	constructor() {
		super();

		this.state = {
			'showPrivacyModal': false,
			'showCopyrightModal': false
		}
	}

	toggleModal(property, e) {
		if (e) {
			e.preventDefault();
		}
		this.setState({
			[property]: !this.state[property]
		});
	}

	render() {
		return (
			<footer>
				<div className="sub-footer text-center row" id="contact">
					<div className="small-12 large-4 columns column-filler"></div>
					<div className="small-12 large-4 columns">
						<img src="/images/Titles/Contact_Us.png" alt="" />
						<div className="contact-info">
							<h4 className="left">By Phone: (909) 343-5454</h4>
						    <h4 className="left">By E-mail: Contact@Battle-Comm.com</h4>
						    <h4 className="left">Address: 555 Boutel Dr.</h4>
						    <h4 className="indent left">Sacramento, CA</h4>
						</div>
					</div>
					<div className="small-12 large-4 columns">
						<img src="/images/Titles/Follow_Us.png" alt="" />
					    <div className="social-links">
					        <a href="https://www.facebook.com/battlecomm" target="_blank">
					            <span className="fa fa-facebook-square"></span>
					        </a>
					        <a href="https://twitter.com/Battle_Comm" target="_blank">
					            <span className="fa fa-twitter-square"></span>
					        </a>
					        <a href="https://instagram.com/Battle_Comm" target="_blank">
					            <span className="fa fa-instagram"></span>
					        </a>
					    </div>
					</div>
				</div>
				<div className="site-footer center">
					<div className="copyright">© 2015 Battle-Comm. All Rights Reserved.
				        <br />
						<div className="statement-links">
							<div className="privacy-policy"><a onClick={this.toggleModal.bind(this, 'showPrivacyModal')}>Privacy Policy</a> ~ </div>
					        <div className="copyright-statement">
								<a onClick={this.toggleModal.bind(this, 'showCopyrightModal')} className="open-popup-link">Copyright Statement</a>
					        </div>
						</div>
					</div>
				</div>
				<Modal name="privacyPolicyModal" title="Privacy Policy" modalIsOpen={this.state.showPrivacyModal} handleClose={this.toggleModal.bind(this, 'showPrivacyModal')} showClose={true} showFooter={false}>Content for Privacy Policy</Modal>
				<Modal name="copyrightStatementModal" title="Copyright Statement" modalIsOpen={this.state.showCopyrightModal} handleClose={this.toggleModal.bind(this, 'showCopyrightModal')} showClose={true} showFooter={false}>All copyrights belong to their respective owners. Images and text owned by other copyright holders are used here under the guidelines of the Fair Use provisions of United States Copyright Law.</Modal>
    		</footer>
	    );
	}
}
