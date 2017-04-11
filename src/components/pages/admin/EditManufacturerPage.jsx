'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import {AlertActions} from '../../../library/alerts';
import {handlers, uploadFiles} from '../../../library/utilities';
import {Form, Input, TextArea, Select, FileUpload} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import FileService from '../../../services/FileService';
import ManufacturerService from '../../../services/ManufacturerService';
import AdminMenu from '../../pieces/AdminMenu';

export default class EditManufacturerPage extends React.Component {
	constructor() {
		super();

		this.state = {
			'manufacturer': {
				'File': {}
			},
			'newFilesUploaded': false,
			'newManufacturer': false
		}

		this.handleDeleteFile = this.handleDeleteFile.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
	}

	componentDidMount() {
		document.title = "Battle-Comm | Manufacturer Edit";
		if (this.props.params.manufacturerId) {
			ManufacturerService.get(this.props.params.manufacturerId).then((manufacturer) => {
				this.setState({
					'manufacturer': manufacturer
				});
			});
		} else {
			this.setState({
				'newManufacturer': true
			})
		}
	}

	handleDeleteFile(fileId) {
		FileService.remove(fileId).then(() => {
			this.showAlert('fileRemoved');
		});
	}

	handleFileUpload(files) {
		let manufacturer = this.state.manufacturer;
		this.uploadFiles(files).then((responses) => {
			responses = responses.map((response, i) => {
				response = {
					'name': response.data.file.name,
					'size': response.data.file.size,
					'type': response.data.file.type
				};
				return response;
			});
			manufacturer.File = responses[0];
			this.setState({
				'manufacturer': manufacturer,
				'newFilesUploaded': true
			});
			this.showAlert('uploadSuccess');
		});
	}

	handleInputChange(e) {
		this.setState({
			'manufacturer': handlers.updateInput(e, this.state.manufacturer)
		});
	}

	handleSubmit() {
		let method = this.props.params.manufacturerId ? 'update': 'create';
		ManufacturerService[method]((method === 'update' ? this.state.manufacturer.id : this.state.manufacturer), (method === 'update' ? this.state.manufacturer : null)).then((manufacturer) => {
			if (this.state.newFilesUploaded) {
				FileService.create({
					'ManufacturerId': manufacturer.id,
					'identifier': 'manufacturerPhoto',
					'locationUrl': `manufacturers/${this.state.manufacturer.File.name}`,
					'name': this.state.manufacturer.File.name,
					'size': this.state.manufacturer.File.size,
					'type': this.state.manufacturer.File.type
				})
			}
			this.setState({
				'manufacturer': manufacturer
			});
			if (method === 'update') {
				this.addAlert('manufacturerUpdated');
				browserHistory.push('/admin');
			} else {
				this.addAlert('manufacturerCreated');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'manufacturerCreated': () => {
				this.props.addAlert({
					'title': 'New Manufacturer Added',
					'message': `Manufacturer, ${this.state.manufacturer.name}, successfully created.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'manufacturerUpdated': () => {
				this.props.addAlert({
					'title': 'New Manufacturer Added',
					'message': `Manufacturer, ${this.state.manufacturer.name}, successfully updated`,
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

	uploadFiles(files) {
		let directoryPath = `manufacturers/`;
		return uploadFiles(files, '/files/add', directoryPath, {
			'identifier': 'manufacturerPhoto'
		});
	}

	render() {
		<ViewWrapper>
			<div className="small-12 columns">
				<h1>Manufacturer Edit</h1>
				<hr/>
				<AdminMenu></AdminMenu>
				<hr/>
			</div>
			<div className="row">
				<div className="small-12 medium-8 large-9 columns">
					<Form name="manufacturerForm" submitText={this.state.newGameSystem ? 'Create Manufacturer' : 'Update Manufacturer'} handleSubmit={this.handleSubmit}>
						<div className="row">
							<div className="form-group small-12 medium-3 columns">
								<label className="required">Manufacturer Name</label>
								<Input type="text" name="name" value={this.state.manufacturer.name} handleInputChange={this.handleInputChange} required={true} />
							</div>
							<div className="form-group small-12 medium-3 columns">
								<label className="required">Search Key</label>
								<Input type="text" name="searchKey" value={this.state.manufacturer.searchKey} handleInputChange={this.handleInputChange} required={true} />
							</div>
							<div className="form-group small-12 medium-3 columns">
								<label>Url to Related Webpage</label>
								<Input type="text" name="url" value={this.state.manufacturer.url} handleInputChange={this.handleInputChange} />
							</div>
							<div className="form-group small-12 medium-3 columns">
								<label>Related Photo</label>
								<FileUpload name="gameSystemPhoto" value={this.state.manufacturer.File} handleFileUpload={this.handleFileUpload} handleDeleteFile={handleDeleteFile} maxFiles={1} />
							</div>
						</div>
						<div className="row">
							<div className="form-group small-12 medium-12 columns">
								<label>Description</label>
								<TextArea name="description" value={this.state.manufacturer.description} handleInputChange={this.handleInputChange} rows="3"/>
							</div>
						</div>
					</Form>
				</div>
				<div className="small-12 medium-8 large-9 columns">
					Filters
				</div>
			</div>
		</ViewWrapper>
	}
}
