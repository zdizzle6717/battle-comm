'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import {UserService} from '../../../library/authentication';
import {AlertActions} from '../../../library/alerts';
import {handlers} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import AdminMenu from '../../pieces/AdminMenu';
import roleConfig from '../../../../roleConfig';
import GameSystemRankingForm from '../../pieces/forms/GameSystemRankingForm';
import Modal from '../../../library/modal';
import PlayerService from '../../../services/PlayerService';

const mapStateToProps = (state) => {
	return {
		'forms': state.forms
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert
	}, dispatch);
}

class EditUser extends React.Component {
    constructor() {
        super();

		this.state = {
			'deleteModalIsActive': false,
			'user': {
				'GameSystemRankings': []
			},
			'newUser': false,
			'isEditing': false
		}

		this.handleActivateAccount = this.handleActivateAccount.bind(this);
		this.handleBlockUser = this.handleBlockUser.bind(this);
		this.handleDeleteUser = this.handleDeleteUser.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleRoleChange = this.handleRoleChange.bind(this);
		this.handleRankingSubmit = this.handleRankingSubmit.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.toggleDeleteUserModal = this.toggleDeleteUserModal.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.toggleEditing = this.toggleEditing.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | User Edit";
		if (this.props.match.params.userId) {
			PlayerService.getById(this.props.match.params.userId).then((user) => {
				this.setState({
					'user': user
				});
			});
		} else {
			this.props.history.push('/admin/users')
		}
    }

	handleActivateAccount(e) {
		e.preventDefault();
		PlayerService.activateAccount(this.state.user.id).then((user) => {
			this.setState({
				'user': user
			})
		});
	}

	handleBlockUser(e) {
		e.preventDefault();
		PlayerService.blockUser(this.state.user.id, {
			'accountBlocked': !this.state.user.accountBlocked
		}).then((user) => {
			this.setState({
				'user': user
			})
		});
	}

	handleDeleteUser(e) {
		e.preventDefault();
		UserService.remove(this.state.user.id).then(() => {
			this.showAlert('userDeleted');
			this.props.history.push('/admin/users');
		});
	}

	handleInputChange(e) {
		this.setState({
			'user': handlers.updateInput(e, this.state.user)
		});
	}

	handleRoleChange(e) {
		let role = e.target.value;
		e.preventDefault();
		PlayerService.updateRole(this.state.user.id, {
			'role': role
		}).then((user) => {
			this.setState({
				'userRole': role
			});
		});
	}

	handleRankingSubmit() {
		this.props.history.push('/admin/users');
	}

	handleSubmit(e) {
		e.preventDefault();
		let order = this.state.user;
		let method = this.props.match.params.userId ? 'update' : 'create';
		PlayerService.update(order.id, order).then((user) => {
			this.setState({
				'user': user
			});
			this.showAlert('userUpdated');
			this.setState({
				'isEditing': false
			})
		});
	}

	toggleDeleteUserModal(e) {
		e.preventDefault();
		this.setState({
			'deleteModalIsActive': !this.state.deleteModalIsActive
		});
	}

	showAlert(selector) {
		const alerts = {
			'userDeleted': () => {
				this.props.addAlert({
					'title': 'User Deleted',
					'message': `User, ${this.state.user.username}, was removed from the database.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'userUpdated': () => {
				this.props.addAlert({
					'title': 'User Updated',
					'message': `User, ${this.state.user.username}, was successfully updated.`,
					'type': 'success',
					'delay': 3000
				});
			}
		}

		return alerts[selector]();
	}

	toggleEditing(e) {
		e.preventDefault();
		this.setState({
			'isEditing': !this.state.isEditing
		})
	}

    render() {
		let formIsInvalid = getFormErrorCount(this.props.forms, 'userForm') > 0;

        return (
            <ViewWrapper headerImage="/images/Titles/Player_Edit.png" headerAlt="Player Edit">
                <div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
                </div>
				<div className="row">
					<div className="small-12 columns">
						<h2>Edit user {this.state.user.username}</h2>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<fieldset disabled={!this.state.isEditing}>
							<Form name="userForm" submitButton={false} handleSubmit={this.handleSubmit}>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">First Name</label>
										<Input type="text" name="firstName" value={this.state.user.firstName} handleInputChange={this.handleInputChange} required={true}/>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Last Name</label>
										<Input type="text" name="lastName" value={this.state.user.lastName} handleInputChange={this.handleInputChange} required={true}/>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">E-mail</label>
										<Input type="text" name="email" value={this.state.user.email} handleInputChange={this.handleInputChange} required={true}/>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Handle</label>
										<Input type="text" name="username" value={this.state.user.username} handleInputChange={this.handleInputChange} required={true}/>
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Reward Points</label>
										<Input type="text" name="rewardPoints" value={this.state.user.rewardPoints} handleInputChange={this.handleInputChange} required={true}/>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 columns">
										<label className="required">Bio</label>
										<TextArea type="text" name="bio" value={this.state.user.bio} handleInputChange={this.handleInputChange} required={true} rows="3"/>
									</div>
								</div>
							</Form>
						</fieldset>
						<hr/>
						<div className="row">
							<div className="small-12 columns">
								<h2>Player Ranking</h2>
								<div className="small-12 columns">
									{
										this.state.user.GameSystemRankings.length < 1 &&
										<h3 className="text-center">{this.state.user.username} has not submitted any game results to the BC leaderboards</h3>
									}
									{
										this.state.user.GameSystemRankings.map((gameRanking, i) =>
										<div key={gameRanking.id} className="row">
											<h4><Link to={`/ranking/search/${gameRanking.GameSystemId}`}>{gameRanking.GameSystem.name}</Link>: {gameRanking.totalWins}/{gameRanking.totalLosses}/{gameRanking.totalDraws}</h4>
											<table className="search-results stack hover text-center">
												<thead>
													<tr>
														<th className="text-center">Game System</th>
														<th className="text-center">Faction</th>
														<th className="text-center">Ranking W/L/D</th>
														<th className="text-center">Point Value</th>
													</tr>
												</thead>
												<tbody>
													{
														gameRanking.FactionRankings.map((factionRanking, j) =>
															<tr key={factionRanking.id} className="item">
																<td><Link to={`/ranking/search/${gameRanking.GameSystemId}`} className="color-black">{gameRanking.GameSystem.name}</Link></td>
																<td><Link to={`/ranking/search/${gameRanking.GameSystemId}/${factionRanking.FactionId}`} className="color-black">{factionRanking.Faction.name}</Link></td>
																<td>{factionRanking.totalWins}/{factionRanking.totalLosses}/{factionRanking.totalDraws}</td>
																<td>{factionRanking.pointValue}</td>
															</tr>
														)
													}
												</tbody>
											</table>
											<hr />
										</div>
										)
									}
								</div>
							</div>
						</div>
						<hr/>
						<div className="row">
							<div className="small-12 columns">
								<h2>Add/Update Player Ranking</h2>
								<GameSystemRankingForm playerId={this.state.user.id} username={this.state.user.username} handleSubmit={this.handleRankingSubmit}></GameSystemRankingForm>
							</div>
						</div>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							{
								this.state.isEditing ?
								<div className="panel-content text-center">
									<button className="button black small-12" onClick={this.handleSubmit} disabled={formIsInvalid}>Save Changes</button>
								</div> :
								<div className="panel-content text-center">
									<button className="button black small-12" onClick={this.toggleEditing}>Edit User?</button>
								</div>
							}
						</div>
						<div className="panel push-bottom-2x push-top">
							{
								this.state.user.accountActivated ?
								<div className="panel-content text-center">
									<span className="fa fa-check color-success"></span> <h5>Account Activated</h5>
								</div> : <div className="panel-content text-center">
									<button className="button info small-12 collapse" onClick={this.handleActivateAccount}>Activate Account?</button>
								</div>
							}
						</div>
						<div className="panel push-bottom-2x push-top">
							<div className="panel-title color-black">
								Update User Role
							</div>
							<div className="panel-content text-center">
								<select type="text" name="userRole" value={this.state.userRole} onChange={this.handleRoleChange}>
									{
										roleConfig.filter(role => role.name !== 'public').map((role, i) =>
											<option key={i} value={role.name}>{role.name}</option>
										)
									}
								</select>
							</div>
						</div>
						<div className="panel push-bottom-2x push-top">
							{
								this.state.user.accountBlocked &&
								<div className="panel-title color-black">
									User is currently blocked
								</div>
							}

							<div className="panel-content text-center">
								<button className="button alert small-12 collapse" onClick={this.handleBlockUser}>{this.state.user.accountBlocked ? 'Unblock User?' : 'Block User?'}</button>
							</div>
						</div>
					</div>
				</div>
				<Modal name="deleteUserModal" title="Delete User" modalIsOpen={this.state.deleteModalIsActive} handleClose={this.toggleDeleteUserModal} showClose={true} handleSubmit={this.handleDeleteUser} confirmText="Delete Permanently">
					Are you sure you want to delete the user account for, {this.state.user.username}?  This action cannot be undone. User data will be removed from the database, and corresponding ranking data will be nullified.
				</Modal>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(EditUser));
