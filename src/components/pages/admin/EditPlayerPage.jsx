'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {UserService} from '../../../library/authentication';
import {AlertActions} from '../../../library/alerts';
import {handlers, uploadFiles} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';

export default class EditPlayerPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'player': {},
			'newPlayer': false
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Player Edit";
		if (this.props.params.orderId) {
			UserService.get(this.props.params.orderId).then((player) => {
				this.setState({
					'player': player
				});
			});
		} else {
			this.setState({
				'newPlayer': true
			})
		}
    }

	handleInputChange(e) {
		this.setState({
			'player': handlers.updateInput(e, this.state.player)
		});
	}

	handleSubmit() {
		let order = this.state.player;
		let method = this.props.params.playerId ? 'update' : 'create';
		UserService[method]((method === 'update' ? order.id : order), (method === 'update' ? order : null)).then((player) => {
			this.setState({
				'player': player
			});
			if (this.props.params.playerId) {
				this.addAlert('playerUpdated');
				browserHistory.push('/admin');
			} else {
				this.addAlert('playerCreated');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'playerCreated': () => {
				this.props.addAlert({
					'title': 'News Order Created',
					'message': `New order successfully created.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'playerUpdated': () => {
				this.props.addAlert({
					'title': 'Player Updated',
					'message': `Order successfully updated.`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

    render() {
        return (
            <ViewWrapper>
                <div className="small-12 columns">
                    <h1>Player Edit</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
				<div className="row">
					<div className="small-12 medium-8 large-9 columns">
						<Form name="playerForm" submitText={this.state.newPlayer ? 'Create Player' : 'Update Player'} handleSubmit={this.handleSubmit}>
							<div className="row">
								<div className="form-group small-12 medium-4 columns">
									<label className="required">Title</label>
									<Input type="text" name="id" value={this.state.player.id} handleInputChange={this.handleInputChange} required={true} disabled={true}/>
								</div>
							</div>
						</Form>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						Filters
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
