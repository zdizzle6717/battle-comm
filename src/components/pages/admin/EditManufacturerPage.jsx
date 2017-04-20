'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
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

class EditManufacturerPage extends React.Component {
	constructor() {
		super();

		this.state = {
			'files': [],
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
					'files': [manufacturer.File],
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
		this.uploadFiles(files).then((files) => {
			files = files.map((file, i) => {
				file = {
					'name': file.data.file.name,
					'size': file.data.file.size,
					'type': file.data.file.type
				};
				return file;
			});
			this.setState({
				'files': files[0],
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

	handleSubmit(e) {
		e.preventDefault();
		let method = this.props.params.manufacturerId ? 'update': 'create';
		ManufacturerService[method]((method === 'update' ? this.state.manufacturer.id : this.state.manufacturer), (method === 'update' ? this.state.manufacturer : null)).then((manufacturer) => {
			if (this.state.newFilesUploaded) {
				FileService.create({
					'ManufacturerId': manufacturer.id,
					'identifier': 'manufacturerPhoto',
					'locationUrl': `manufacturers/`,
					'name': this.state.files[0].name,
					'size': this.state.files[0].size,
					'type': this.state.files[0].type
				})
			}
			this.setState({
				'files': [manufacturer.File],
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
		let formIsValid = getFormErrorCount(this.props.forms, 'manufacturerForm');
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
										<label className="required">Manufacturer Image</label>
										{
											this.state.files.length > 0 &&
											<img src={`/uploads/${this.state.files[0].locationUrl}${this.state.files[0].name}`} />
										}
									</div>
									<div className="small-12 medium-4 columns">
										<label className="required">Image Name</label>
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
										<FileUpload name="manufacturerPhoto" value={this.state.files} handleFileUpload={this.handleFileUpload} handleDeleteFile={this.handleDeleteFile} hideFileList={true} maxFiles={1} accept="image/*"/>
									</div>
								</div>
							</Form>
						</fieldset>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-content text-center">
								<button className="button black small-12" onClick={this.handleSubmit} disabled={!formIsValid}>{this.state.newGameSystem ? 'Create Manufacturer' : 'Update Manufacturer'}</button>
							</div>
						</div>
					</div>
				</div>
			</ViewWrapper>
		)
	}
}

export default connect(mapStateToProps, null)(EditManufacturerPage);
