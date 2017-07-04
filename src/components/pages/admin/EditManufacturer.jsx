'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../../library/alerts';
import {handlers, uploadFiles} from '../../../library/utilities';
import {Form, Input, TextArea, Select, FileUpload, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import FileService from '../../../services/FileService';
import ManufacturerService from '../../../services/ManufacturerService';
import AdminMenu from '../../pieces/AdminMenu';

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

class EditManufacturer extends React.Component {
	constructor() {
		super();

		this.state = {
			'files': [],
			'manufacturer': {
				'File': {}
			},
			'newManufacturer': false,
			'newFiles': []
		}

		this.getManufacturer = this.getManufacturer.bind(this);
		this.handleDeleteFile = this.handleDeleteFile.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
	}

	componentDidMount() {
		document.title = "Battle-Comm | Manufacturer Edit";
		if (this.props.match.params.manufacturerId) {
			this.getManufacturer(this.props.match.params.manufacturerId).catch(() => {
				this.showAlert('notFound');
				this.props.history.push('/admin/manufacturers');
			});
		} else {
			this.setState({
				'newManufacturer': true
			})
		}
	}

	getManufacturer(manufacturerId) {
		return ManufacturerService.get(manufacturerId).then((manufacturer) => {
			this.setState({
				'files': manufacturer.File ? [manufacturer.File] : [],
				'manufacturer': manufacturer
			});
		});
	}

	handleDeleteFile(fileId, index, e) {
		if (e) {
			e.preventDefault();
		}
		FileService.remove(fileId).then(() => {
			let files = this.state.files;
			files.splice(index, 1);
			this.setState({
				'files': files
			});
			this.showAlert('fileRemoved');
		});
	}

	handleFileUpload(files) {
		let manufacturer = this.state.manufacturer;
		let newFiles = this.state.newFiles;
		this.uploadFiles(files).then((responses) => {
			responses = responses.map((response, i) => {
				response = {
					'name': response.data.file.name,
					'size': response.data.file.size,
					'type': response.data.file.type,
					'locationUrl': response.data.file.locationUrl
				};
				return response;
			});
			let files = responses.concat(this.state.files);
			newFiles = newFiles.concat(responses);
			this.setState({
				'files': files,
				'newFiles': newFiles
			});
			this.showAlert('uploadSuccess');
		});
	}

	handleInputChange(e) {
		this.setState({
			'manufacturer': handlers.updateInput(e, this.state.manufacturer)
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		let method = this.props.match.params.manufacturerId ? 'update': 'create';
		let newFiles = this.state.newFiles;
		ManufacturerService[method]((method === 'update' ? this.state.manufacturer.id : this.state.manufacturer), (method === 'update' ? this.state.manufacturer : null)).then((manufacturer) => {
			if (newFiles.length > 0) {
				newFiles.forEach((file) => {
					FileService.create({
						'ManufacturerId': manufacturer.id,
						'identifier': 'manufacturerPhoto',
						'locationUrl': file.locationUrl,
						'name': file.name,
						'size': file.size,
						'type': file.type
					});
				});
			}
			this.setState({
				'manufacturer': manufacturer
			});
			if (method === 'update') {
				this.showAlert('manufacturerUpdated');
				this.props.history.push('/admin/manufacturers');
			} else {
				this.props.history.push(`/admin/manufacturers/edit/${manufacturer.id}`);
				this.showAlert('manufacturerCreated');
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
			'notFound': () => {
				this.props.addAlert({
					'title': 'Manufacturer Not Found',
					'message': `No manufacturer found with id, ${this.props.match.params.manufacturerId}`,
					'type': 'error',
					'delay': 3000
				});
			},
			'uploadSuccess': () => {
				this.props.addAlert({
					'title': 'Upload Success',
					'message': `New file successfully uploaded.  Click 'update' to complete transaction.`,
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
		let formIsInvalid = getFormErrorCount(this.props.forms, 'manufacturerForm') > 0;
		return (
			<ViewWrapper headerImage="/images/Titles/Manufacturer_Edit.png" headerAlt="Manufacturer Edit">
				<div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
				</div>
				<div className="row">
					<div className="small-12 columns">
						<h2>{this.state.newManufacturer ? 'Create New Manufacturer' : `${this.state.manufacturer.name}`}</h2>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<fieldset>
							<Form name="manufacturerForm" submitButton={false} handleSubmit={this.handleSubmit}>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Manufacturer Name</label>
										<Input type="text" name="name" value={this.state.manufacturer.name} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Url to Related Webpage</label>
										<Input type="text" name="url" value={this.state.manufacturer.url} handleInputChange={this.handleInputChange} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Description</label>
										<TextArea name="description" value={this.state.manufacturer.description} handleInputChange={this.handleInputChange} rows="3"/>
									</div>
								</div>
								<div className="row">
									<div className="small-12 medium-4 columns">
										<label>Manufacturer Image</label>
										{
											this.state.files.length > 0 &&
											<img src={`${this.state.files[0].locationUrl}${this.state.files[0].name}`} />
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
											<button className="button alert" onClick={this.handleDeleteFile.bind(this, this.state.files[0].id, 0)}>Delete File?</button>
										}
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Related Photo</label>
										<FileUpload name="manufacturerPhoto" value={this.state.files} handleFileUpload={this.handleFileUpload} handleDeleteFile={this.handleDeleteFile} hideFileList={true} maxFiles={1} accept="image/*"/>
									</div>
								</div>
							</Form>
						</fieldset>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-content text-center">
								<button className="button collapse black small-12" onClick={this.handleSubmit} disabled={formIsInvalid}>{this.state.newGameSystem ? 'Create Manufacturer' : 'Update Manufacturer'}</button>
							</div>
						</div>
					</div>
				</div>
			</ViewWrapper>
		)
	}
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(EditManufacturer));
