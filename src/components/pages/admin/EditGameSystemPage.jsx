'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {browserHistory, Link} from 'react-router';
import {connect} from 'react-redux';
import {Form, Input, TextArea, Select, FileUpload, getFormErrorCount} from '../../../library/validations';
import {handlers, uploadFiles} from '../../../library/utilities';
import {AlertActions} from '../../../library/alerts';
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
			'gameSystemFiles': [],
			'manufacturers': [],
			'newFilesUploaded': false,
			'newGameSystem': false
		}

		this.handleDeleteFile = this.handleDeleteFile.bind(this);
		this.handleFactionInputChange = this.handleFactionInputChange.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSaveFaction = this.handleSaveFaction.bind(this);
		this.handleSaveGameSystem = this.handleSaveGameSystem.bind(this);
		this.showAlert = this.showAlert.bind(this);
	}

    componentDidMount() {
        document.title = "Battle-Comm | Game System Edit";
		this.props.getManufacturers();
		if (this.props.params.gameSystemId) {
			GameSystemService.get(this.props.params.gameSystemId).then((gameSystem) => {
				this.setState({
					'gameSystem': gameSystem
				});
			});
		} else {
			this.setState({
				'newGameSystem': true
			})
		}
    }

	handleDeleteFile(fileId) {
		FileService.remove(fileId).then(() => {
			this.showAlert('fileRemoved');
		});
	}

	handleDeleteFaction(factionId, index) {
		FactionService.remove(factionId).then((response) => {
			let gameSystem = this.state.gameSystem;
			gameSystem.Factions.splice(index, 1);
			this.setState({
				'gameSystem': gameSystem
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
				'gameSystemFiles': responses,
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
				this.addAlert('gameSystemUpdated');
				browserHistory.push('/admin');
			} else {
				this.addAlert('gameSystemCreated');
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
			gameSystem.push(faction);
			this.setState({
				'gameSystem': gameSystem,
				'faction': {}
			});
			this.showAlert('factionCreated');
		});
	}

	uploadFiles(files) {
		let directoryPath = `gameSystems/`;
		return uploadFiles(files, '/files/add', directoryPath, {
			'identifier': 'gameSystemPhoto'
		});
	}

	showAlert(selector) {
		const alerts = {
			'factionCreated': () => {
				this.props.addAlert({
					'title': 'New Faction Added',
					'message': `Faction, ${this.state.faction.name}, successfully added to ${this.state.gameSystem.name}`,
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
			'uploadSuccess': () => {
				this.props.addAlert({
					'title': 'Upload Success',
					'message': `New file successfully uploaded`,
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

		return alerts[selector]();
	}

    render() {
		let gameSystemFormIsValid = getFormErrorCount(this.props.forms, 'gameSystemForm')

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
							<Form name="gameSystemForm" submitButton={false}}>
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
									<div className="form-group small-12 medium-4 columns">
										<label>Url to Related Webpage</label>
										<Input type="text" name="url" value={this.state.gameSystem.url} handleInputChange={this.handleInputChange} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Search Key</label>
										<Input type="text" name="searchKey" value={this.state.gameSystem.searchKey} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Description</label>
										<TextArea name="description" value={this.state.gameSystem.description} handleInputChange={this.handleInputChange} rows="3"/>
									</div>
								</div>
								<div className="row">
									<div className="small-12 medium-4 columns">
										<label className="required">Featured Image (back)</label>
										{
											this.state.gameSystemFiles.length > 0 &&
											<img src={`/uploads/${this.state.gameSystemFiles[0].locationUrl}${this.state.gameSystemFiles[0].name}`} />
										}
									</div>
									<div className="small-12 medium-4 columns">
										<label className="required">Image Name</label>
										{
											this.state.gameSystemFiles.length > 0 &&
											<h6>{this.state.gameSystemFiles[0].name}</h6>
										}
										{
											this.state.gameSystemFiles.length > 0 && this.state.gameSystemFiles[0].id &&
											<button className="button alert" onClick={this.handleDeleteFile.bind(this, this.state.gameSystemFiles[0].id)}>Delete File?</button>
										}
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Related Photo</label>
										<FileUpload name="gameSystemPhoto" value={this.state.gameSystemFiles} handleFileUpload={this.handleFileUpload} handleDeleteFile={this.handleDeleteFile} hideFileList={true} maxFiles={1} />
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
											<div key={i} className="pill">{faction} <span className="fa fa-times" onClick={this.handleDeleteFaction.bind(this, faction.id, i)}></span></div>
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
								<button onClick={this.handleSaveGameSystem} disabled={!gameSystemFormIsValid}>{this.state.newGameSystem ? 'Create Game System' : 'Update Game System'}</button>
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(EditGameSystemPage);
