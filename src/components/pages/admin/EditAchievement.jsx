'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import {AlertActions} from '../../../library/alerts';
import {handlers, uploadFiles} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, FileUpload, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import FileService from '../../../services/FileService';
import ManufacturerActions from '../../../actions/ManufacturerActions';
import AchievementService from '../../../services/AchievementService';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
	return {
		'manufacturers': state.manufacturers,
		'user': state.user,
		'forms': state.forms
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'getManufacturer': ManufacturerActions.get,
		'getManufacturers': ManufacturerActions.getAll
	}, dispatch);
}

class EditAchievement extends React.Component {
	constructor() {
		super();

		this.state = {
			'files': [],
			'gameSystems': [],
			'achievement': {
				'priority': 100,
				'File': {}
			},
			'newAchievement': false,
			'newFiles': []
		}

		this.handleDeleteFile = this.handleDeleteFile.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleDeleteAchievement = this.handleDeleteAchievement.bind(this);
		this.handleCheckBoxChange = this.handleCheckBoxChange.bind(this);
		this.handleManufacturerChange = this.handleManufacturerChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.uploadFiles = this.uploadFiles.bind(this);
	}

	componentDidMount() {
		document.title = "Battle-Comm | Achievement Edit";
		this.props.getManufacturers();
		if (this.props.match.params.achievementId) {
			AchievementService.get(this.props.match.params.achievementId).then((achievement) => {
				this.setState({
					'achievement': achievement,
					'files': achievement.File ? [achievement.File] : []
				});
			}).catch(() => {
				this.showAlert('notFound');
				this.props.history.push('/admin/achievements');
			});
		} else {
			this.setState({
				'newAchievement': true
			})
		}
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

	handleDeleteAchievement() {
		AchievementService.remove(this.props.match.params.achievementId).then(() => {
			this.showAlert('achievementDeleted');
			this.props.history.push('/admin/achievements');
		});
	}

	handleFileUpload(files) {
		let achievement = this.state.achievement;
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

	handleCheckBoxChange(e) {
		this.setState({
			'achievement': handlers.updateCheckBox(e, this.state.achievement)
		});
	}

	handleInputChange(e) {
		this.setState({
			'achievement': handlers.updateInput(e, this.state.achievement)
		});
	}

	handleManufacturerChange(e) {
		let achievement = this.state.achievement;
		achievement.ManufacturerId = e.target.value;
		achievement.GameSystemId = undefined;
		this.props.getManufacturer(e.target.value).then((manufacturer) => {
			this.setState({
				'achievement': achievement,
				'gameSystems': manufacturer.GameSystems
			});
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		let post = this.state.achievement;
		let method = this.props.match.params.achievementId ? 'update' : 'create';
		let newFiles = this.state.newFiles;
		AchievementService[method]((method === 'update' ? post.id : post), (method === 'update' ? post : null)).then((achievement) => {
			if (newFiles.length > 0) {
				newFiles.forEach((file) => {
					FileService.create({
						'AchievementId': achievement.id,
						'identifier': 'achievement',
						'locationUrl': file.locationUrl,
						'name': file.name,
						'size': file.size,
						'type': file.type
					});
				});
			}
			this.setState({
				'achievement': achievement
			});
			if (this.props.match.params.achievementId) {
				this.showAlert('achievementUpdated');
				this.props.history.push('/admin/achievements');
			} else {
				this.showAlert('achievementCreated');
					this.props.history.push(`/admin/achievements/edit/${achievement.id}`);
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'achievementCreated': () => {
				this.props.addAlert({
					'title': 'Achievement Created',
					'message': `New achievement, ${this.state.achievement.title}, successfully created.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'achievementUpdated': () => {
				this.props.addAlert({
					'title': 'Achievement Updated',
					'message': `Achievement, ${this.state.achievement.title}, was successfully updated.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'notFound': () => {
				this.props.addAlert({
					'title': 'Achievement Not Found',
					'message': `No achievement found with id, ${this.props.match.params.achievementId}`,
					'type': 'error',
					'delay': 3000
				});
			},
			'achievementDeleted': () => {
				this.props.addAlert({
					'title': 'Achievement Deleted',
					'message': 'Achievement was successfully deleted from database.',
					'type': 'success',
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
		let directoryPath = `achievements/`;
		return uploadFiles(files, '/files/add', directoryPath, {
			'identifier': 'achievement'
		});
	}

	render() {
		let formIsInvalid = getFormErrorCount(this.props.forms, 'achievementForm') > 0;

		return (
			<ViewWrapper headerImage="/images/Titles/Achievement_Edit.png" headerAlt="Achievement Edit">
				<div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
				</div>
				<div className="row">
					<div className="small-12 columns">
						<h2>{this.state.newAchievement ? 'Create Achievement' : `${this.state.achievement.title}`}</h2>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<fieldset>
							<Form name="achievementForm" submitButton={false} handleSubmit={this.handleSubmit}>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Title</label>
										<Input type="text" name="title" value={this.state.achievement.title} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Category</label>
										<Input type="text" name="category" value={this.state.achievement.category} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Priority</label>
										<Input type="number" name="priority" value={this.state.achievement.priority} handleInputChange={this.handleInputChange} step="1" required={true} />
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 columns">
										<label className="required">Description</label>
										<TextArea type="text" name="description" value={this.state.achievement.description} rows="4" handleInputChange={this.handleInputChange} required={true} />
									</div>
								</div>
								<div className="row">
									<div className="small-12 medium-4 columns">
										<label>Achievement Icon</label>
										{
											this.state.files[0] &&
											<div>
												{
													this.state.files.length > 0 &&
													<img src={`${this.state.files[0].locationUrl}${this.state.files[0].name}`} />
												}
											</div>
										}
									</div>
									<div className="small-12 medium-4 columns">
										<label>Image Name</label>
										<div>
											{
												this.state.files.length > 0 &&
												<h6>{this.state.files[0].name}</h6>
											}
											{
												this.state.files.length > 0 && this.state.files[0].id &&
												<button className="button alert" onClick={this.handleDeleteFile.bind(this, this.state.files[0].id, 0)}>Delete File?</button>
											}
										</div>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Upload File</label>
										<FileUpload name="achievement" value={this.state.files} handleFileUpload={this.handleFileUpload} handleDeleteFile={this.handleDeleteFile} hideFileList={true} accept="image/*" maxFiles={1}/>
									</div>
								</div>
							</Form>
						</fieldset>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-content text-center">
								<button className="button collapse black small-12" onClick={this.handleSubmit} disabled={formIsInvalid}>{this.state.newAchievement ? 'Create Achievement' : 'Update Achievement'}</button>
							</div>
						</div>
						{
							this.props.match.params.achievementId &&
							<div className="panel push-bottom-2x push-top">
								<div className="panel-content text-center">
									<button className="button collapse alert small-12" onClick={this.handleDeleteAchievement}>Delete Achievement?</button>
								</div>
							</div>
						}
					</div>
				</div>
			</ViewWrapper>
		)
	}
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(EditAchievement));
