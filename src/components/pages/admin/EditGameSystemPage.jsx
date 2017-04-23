'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {browserHistory, Link} from 'react-router';
import {connect} from 'react-redux';
import {Form, Input, TextArea, Select, FileUpload, getFormErrorCount} from '../../../library/validations';
import {handlers, uploadFiles} from '../../../library/utilities';
import {AlertActions} from '../../../library/alerts';
import Modal from '../../../library/modal';
import ViewWrapper from '../../ViewWrapper';
import FactionActions from '../../../actions/FactionActions';
import ManufacturerActions from '../../../actions/ManufacturerActions';
import FactionService from '../../../services/FactionService';
import FileService from '../../../services/FileService';
import GameSystemService from '../../../services/GameSystemService';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
	return {
		'manufacturers': state.manufacturers,
		'forms': state.forms
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'getManufacturers': ManufacturerActions.getAll
	}, dispatch);
}

class EditGameSystemPage extends React.Component {
	constructor() {
		super();

		this.state = {
			'faction': {},
			'gameSystem': {
				'Factions': [],
				'File': {}
			},
			'files': [],
			'manufacturers': [],
			'newFilesUploaded': false,
			'newGameSystem': false,
			'selectedFaction': {
				'index': null,
				'id': null,
				'name': null
			},
			'deleteFactionModalIsActive': false
		}

		this.handleDeleteFaction = this.handleDeleteFaction.bind(this);
		this.handleDeleteFile = this.handleDeleteFile.bind(this);
		this.handleFactionInputChange = this.handleFactionInputChange.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSaveFaction = this.handleSaveFaction.bind(this);
		this.handleSaveGameSystem = this.handleSaveGameSystem.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.toggleDeleteFactionModal = this.toggleDeleteFactionModal.bind(this);
	}

    componentDidMount() {
        document.title = "Battle-Comm | Game System Edit";
		this.props.getManufacturers();
		if (this.props.params.gameSystemId) {
			this.getGameSystem(this.props.params.gameSystemId).catch(() => {
				browserHistory.push('/admin/game-systems');
				this.showAlert('notFound');
			});
		} else {
			this.setState({
				'newGameSystem': true
			})
		}
    }

	getGameSystem(gameSystemId) {
		return GameSystemService.get(gameSystemId).then((gameSystem) => {
			this.setState({
				'gameSystem': gameSystem,
				'files': gameSystem.File ? [gameSystem.File] : []
			});
		});
	}

	handleDeleteFile(fileId, e) {
		if (e) {
			e.preventDefault();
		}
		FileService.remove(fileId).then(() => {
			this.setState({
				'files': []
			})
			this.showAlert('fileRemoved');
		});
	}

	handleDeleteFaction() {
		FactionService.remove(this.state.selectedFaction.id).then((response) => {
			let gameSystem = this.state.gameSystem;
			gameSystem.Factions.splice(this.state.selectedFaction.index, 1);
			this.setState({
				'gameSystem': gameSystem,
				'deleteFactionModalIsActive': !this.state.deleteFactionModalIsActive
			});
			this.showAlert('factionDeleted');
		});
	}

	handleFactionInputChange(e) {
		this.setState({
			'faction': handlers.updateInput(e, this.state.faction)
		});
	}

	handleFileUpload(files) {
		let gameSystem = this.state.gameSystem;
		this.uploadFiles(files).then((responses) => {
			responses = responses.map((response, i) => {
				response = {
					'name': response.data.file.name,
					'size': response.data.file.size,
					'type': response.data.file.type
				};
				return response;
			});
			gameSystem.File = responses[0];
			this.setState({
				'gameSystem': gameSystem,
				'files': responses,
				'newFilesUploaded': true
			});
			this.showAlert('uploadSuccess');
		});
	}

	handleInputChange(e) {
		this.setState({
			'gameSystem': handlers.updateInput(e, this.state.gameSystem)
		});
	}

	handleSaveGameSystem(e) {
		e.preventDefault();
		let system = this.state.gameSystem;
		let method = this.props.params.gameSystemId ? 'update' : 'create';
		GameSystemService[method]((method === 'update' ? system.id : system), (method === 'update' ? system : null)).then((gameSystem) => {
			if (this.state.newFilesUploaded) {
				FileService.create({
					'GameSystemId': gameSystem.id,
					'identifier': 'gameSystemPhoto',
					'locationUrl': 'gameSystems/',
					'name': this.state.gameSystem.File.name,
					'size': this.state.gameSystem.File.size,
					'type': this.state.gameSystem.File.type
				});
			}
			if (method === 'update') {
				this.showAlert('gameSystemUpdated');
				browserHistory.push('/admin/game-systems');
			} else {
				browserHistory.push(`/admin/game-systems/edit/${gameSystem.id}`);
				this.showAlert('gameSystemCreated');
			}
		});
	}

	handleSaveFaction() {
		let data = {
			'name': this.state.faction.name,
			'GameSystemId': this.props.params.gameSystemId
		};
		FactionService.create(data).then((faction) => {
			let gameSystem = this.state.gameSystem;
			gameSystem.Factions.push(faction);
			this.setState({
				'gameSystem': gameSystem,
				'faction': {
					'name': ''
				}
			});
			this.showAlert('factionCreated', faction.name);
		});
	}

	uploadFiles(files) {
		let directoryPath = `gameSystems/`;
		return uploadFiles(files, '/files/add', directoryPath, {
			'identifier': 'gameSystemPhoto'
		});
	}

	showAlert(selector, data) {
		const alerts = {
			'factionCreated': (data) => {
				this.props.addAlert({
					'title': 'New Faction Added',
					'message': `Faction, ${data}, successfully added to ${this.state.gameSystem.name}`,
					'type': 'success',
					'delay': 3000
				});
			},
			'factionDeleted': () => {
				this.props.addAlert({
					'title': 'Faction Deleted',
					'message': `Faction was successfully deleted`,
					'type': 'info',
					'delay': 3000
				});
			},
			'gameSystemCreated': () => {
				this.props.addAlert({
					'title': 'New Game System Added',
					'message': `Game System, ${this.state.gameSystem.name}, successfully created.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'gameSystemUpdated': () => {
				this.props.addAlert({
					'title': 'New Game System Added',
					'message': `Game System, ${this.state.gameSystem.name}, successfully updated`,
					'type': 'success',
					'delay': 3000
				});
			},
			'notFound': () => {
				this.props.addAlert({
					'title': 'System Not Found',
					'message': `No game system found with id, ${this.props.params.gameSystemId}`,
					'type': 'error',
					'delay': 3000
				});
			},
			'uploadSuccess': () => {
				this.props.addAlert({
					'title': 'Upload Success',
					'message': `New file successfully uploaded. Click 'update' to complete transaction.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'fileRemoved': () => {
				this.props.addAlert({
					'title': 'File Deleted',
					'message': `File was successfully deleted.`,
					'type': 'info',
					'delay': 3000
				});
			}
		}

		return alerts[selector](data);
	}

	toggleDeleteFactionModal(factionId, factionName, index) {
		if (index) {
			this.setState({
				'selectedFaction': {
					'index': index,
					'id': factionId,
					'name': factionName
				}
			});
		}
		this.setState({
			'deleteFactionModalIsActive': !this.state.deleteFactionModalIsActive
		});
	}

    render() {
		let gameSystemFormIsInvalid = getFormErrorCount(this.props.forms, 'gameSystemForm') > 0;

        return (
            <ViewWrapper headerImage="/images/Titles/Game_System_Edit.png" headerAlt="Game System Edit">
                <div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
                </div>
				<div className="row">
					<div className="small-12 columns">
						<h2>{this.state.newGameSystem ? 'Create New Game System' : `${this.state.gameSystem.name}`}</h2>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<fieldset>
							<Form name="gameSystemForm" submitButton={false}>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Game System Name</label>
										<Input type="text" name="name" value={this.state.gameSystem.name} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Manufacturer</label>
										<Select name="ManufacturerId" value={this.state.gameSystem.ManufacturerId} handleInputChange={this.handleInputChange} required={true}>
											<option value="">--Select--</option>
											{
												this.props.manufacturers.map((manufacturer, i) =>
													<option key={i} value={manufacturer.id}>{manufacturer.name}</option>
												)
											}
										</Select>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label>Url to Related Webpage</label>
										<Input type="text" name="url" value={this.state.gameSystem.url} handleInputChange={this.handleInputChange} />
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label>Description</label>
										<TextArea name="description" value={this.state.gameSystem.description} handleInputChange={this.handleInputChange} rows="3"/>
									</div>
								</div>
								<div className="row">
									<div className="small-12 medium-4 columns">
										<label>Featured Image (back)</label>
										{
											this.state.files.length > 0 && this.state.files[0].id &&
											<img src={`/uploads/${this.state.files[0].locationUrl}${this.state.files[0].name}`} />
										}
									</div>
									<div className="small-12 medium-4 columns">
										<label>Image Name</label>
										{
											this.state.files.length > 0 &&
											<h6>{this.state.files[0].name}</h6>
										}
										{
											this.state.files.length > 0 && this.state.files[0].id &&
											<button className="button alert" onClick={this.handleDeleteFile.bind(this, this.state.files[0].id)}>Delete File?</button>
										}
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Related Photo</label>
										<FileUpload name="gameSystemPhoto" value={this.state.files} handleFileUpload={this.handleFileUpload} handleDeleteFile={this.handleDeleteFile} hideFileList={true} accept="image/*" maxFiles={1} />
									</div>
								</div>
							</Form>
						</fieldset>
						{
							!this.state.newGameSystem &&
							<div>
								<h2>Current Faction List</h2>
								<div className="pill-group">
									{
										this.state.gameSystem.Factions.map((faction, i) =>
											<div key={i} className="pill">{faction.name} <span className="fa fa-times pointer" onClick={this.toggleDeleteFactionModal.bind(this, faction.id, faction.name, i)}></span>
											</div>
										)
									}
								</div>
								<h2>Add Faction</h2>
								<fieldset>
									<Form name="factionForm" submitText="Save Faction" handleSubmit={this.handleSaveFaction}>
										<div className="row">
											<div className="form-group small-12 medium-6 columns">
												<label className="required">Faction Name</label>
												<Input type="text" name="name" value={this.state.faction.name} handleInputChange={this.handleFactionInputChange} required={true} />
											</div>
										</div>
									</Form>
								</fieldset>
							</div>
						}
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-content text-center">
								<button className="button black small-12" onClick={this.handleSaveGameSystem} disabled={gameSystemFormIsInvalid}>{this.state.newGameSystem ? 'Create Game System' : 'Update Game System'}</button>
							</div>
						</div>
					</div>
				</div>
				<Modal name="deleteFactionModal" title={`Delete faction, ${this.state.selectedFaction.name}`} modalIsOpen={this.state.deleteFactionModalIsActive} handleClose={this.toggleDeleteFactionModal} showClose={true} handleSubmit={this.handleDeleteFaction} confirmText="Delete Permanently">
					Are you sure you want to delete this faction?  This action cannot be undone. All data will be removed from the database, and corresponding ranking data will be nullified.
				</Modal>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(EditGameSystemPage);
