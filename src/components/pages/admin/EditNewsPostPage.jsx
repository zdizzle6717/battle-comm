'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import {AlertActions} from '../../../library/alerts';
import {handlers, uploadFiles} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, FileUpload, getFormErrorCount} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import FileService from '../../../services/FileService';
import ManufacturerActions from '../../../actions/ManufacturerActions';
import NewsPostService from '../../../services/NewsPostService';
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

class EditNewsPostPage extends React.Component {
	constructor() {
		super();

		this.state = {
			'gameSystems': [],
			'newsPost': {
				'Files': [],
				'category': 'bcNews'
			},
			'newNewsPost': false,
			'newFiles': []
		}

		this.getDirectoryPath = this.getDirectoryPath.bind(this);
		this.handleDeleteFile = this.handleDeleteFile.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleCheckBoxChange = this.handleCheckBoxChange.bind(this);
		this.handleManufacturerChange = this.handleManufacturerChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.uploadFiles = this.uploadFiles.bind(this);
	}

	componentDidMount() {
		document.title = "Battle-Comm | News Post Edit";
		this.props.getManufacturers();
		if (this.props.params.postId) {
			NewsPostService.get(this.props.params.postId).then((newsPost) => {
				this.setState({
					'newsPost': newsPost
				});
				if (newsPost.ManufacturerId) {
					this.props.getManufacturer(newsPost.ManufacturerId).then((manufacturer) => {
						this.setState({
							'gameSystems': manufacturer.GameSystems
						});
					});
				}
			});
		} else {
			this.setState({
				'newNewsPost': true
			})
		}
	}

	getImageUrl(file) {
		if (file.id) {
			return `/uploads/${file.locationUrl}${file.name}`;
		} else {
			return file.locationUrl + file.name;
		}
	}

	getDirectoryPath() {
		let date = this.state.newsPost.createdAt ? new Date(this.state.newsPost.createdAt) : new Date();
		let year = date.getFullYear();
		let month = date.getMonth() + 1;
		return `news/${year}/${month}/`;
	}

	handleDeleteFile(fileId, e) {
		if (e) {
			e.preventDefault();
		}
		FileService.remove(fileId).then(() => {
			this.showAlert('fileRemoved');
		});
	}

	handleFileUpload(files) {
		let newsPost = this.state.newsPost;
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
			let newFileList = responses.concat(newsPost.Files);
			newsPost.Files = newFileList;
			newFiles = newFiles.concat(responses);
			this.setState({
				'newsPost': newsPost,
				'newFiles': newFiles
			});
			this.showAlert('uploadSuccess');
		});
	}

	handleCheckBoxChange(e) {
		this.setState({
			'newsPost': handlers.updateCheckBox(e, this.state.newsPost)
		});
	}

	handleInputChange(e) {
		this.setState({
			'newsPost': handlers.updateInput(e, this.state.newsPost)
		});
	}

	handleManufacturerChange(e) {
		let newsPost = this.state.newsPost;
		newsPost.ManufacturerId = e.target.value;
		newsPost.GameSystemId = undefined;
		this.props.getManufacturer(e.target.value).then((manufacturer) => {
			this.setState({
				'newsPost': newsPost,
				'gameSystems': manufacturer.GameSystems
			});
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		let post = this.state.newsPost;
		let method = this.props.params.postId ? 'update' : 'create';
		post.UserId = this.props.user.id;
		NewsPostService[method]((method === 'update' ? post.id : post), (method === 'update' ? post : null)).then((newsPost) => {
			let directoryPath = this.getDirectoryPath();
			let newFiles = this.state.newFiles;
			if (newFiles.length > 0) {
				newFiles.forEach((file, i) => {
					FileService.create({
						'NewsPostId': newsPost.id,
						'identifier': 'newsPostPhoto',
						'locationUrl': `${directoryPath}`,
						'name': file[i].name,
						'size': file[i].size,
						'type': file[i].type
					});
				});
			}
			this.setState({
				'newsPost': newsPost
			});
			if (this.props.params.postId) {
				this.addAlert('newsPostUpdated');
				browserHistory.push('/admin');
			} else {
				this.addAlert('newsPostCreated');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'newsPostCreated': () => {
				this.props.addAlert({
					'title': 'News Post Created',
					'message': `New post, ${this.state.newsPost.title}, successfully created.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'newsPostUpdated': () => {
				this.props.addAlert({
					'title': 'News Post Updated',
					'message': `Post, ${this.state.newsPost.title}, was successfully updated.`,
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
		let directoryPath = this.getDirectoryPath();
		return uploadFiles(files, '/files/add', directoryPath, {
			'identifier': 'newsPostPhoto'
		});
	}

	render() {
		let formIsInvalid = getFormErrorCount(this.props.forms, 'newsPostForm') > 0;

		return (
			<ViewWrapper headerImage="/images/Titles/News_Post_Edit.png" headerAlt="News Post Edit">
				<div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
				</div>
				<div className="row">
					<div className="small-12 columns">
						<h2>{this.state.newNewsPost ? 'Create News Post' : `${this.state.newsPost.title}`}</h2>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<fieldset>
							<Form name="newsPostForm" submitButton={false} handleSubmit={this.handleSubmit}>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Title</label>
										<Input type="text" name="title" value={this.state.newsPost.title} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<CheckBox name="published" value={this.state.newsPost.published} handleInputChange={this.handleCheckBoxChange} label="Publish on News Page?"/>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<CheckBox name="featured" value={this.state.newsPost.featured} handleInputChange={this.handleCheckBoxChange} label="Feature this post?"/>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label>Manufacturer</label>
										<Select name="ManufacturerId" value={this.state.newsPost.ManufacturerId} handleInputChange={this.handleManufacturerChange}>
											<option value="">--Select--</option>
											{
												this.props.manufacturers.map((manufacturer, i) =>
													<option key={i} value={manufacturer.id}>{manufacturer.name}</option>
												)
											}
										</Select>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Game System</label>
										<Select name="GameSystemId" value={this.state.newsPost.GameSystemId} handleInputChange={this.handleInputChange}>
											<option value="">--Select--</option>
											{
												this.state.gameSystems.map((gameSystems, i) =>
													<option key={i} value={gameSystems.id}>{gameSystems.name}</option>
												)
											}
										</Select>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Category</label>
										<Select name="category" value={this.state.newsPost.category} handleInputChange={this.handleInputChange}>
											<option value="bcNews">BC News</option>
											<option value="events">Events/Tournaments</option>
											<option value="announcements">Announcements</option>
											<option value="miscellaneous">Miscellaneous</option>
										</Select>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 columns">
										<label className="required">Callout</label>
										<TextArea type="text" name="callout" value={this.state.newsPost.callout} rows="4" handleInputChange={this.handleInputChange} required={true} />
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 columns">
										<label className="required">Body</label>
										<TextArea type="text" name="body" value={this.state.newsPost.body} rows="7" handleInputChange={this.handleInputChange} required={true} />
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 columns">
										<label className="required">Tags</label>
										<TextArea type="text" name="tags" value={this.state.newsPost.tags} rows="3" handleInputChange={this.handleInputChange} required={true} />
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 columns">
										<label>News Post Photos</label>
										<FileUpload name="newsPostPhoto" value={this.state.newsPost.Files} handleFileUpload={this.handleFileUpload} handleDeleteFile={this.handleDeleteFile} hideFileList={true} accept="image/*" maxFiles={5} />
									</div>
								</div>
								{
									this.state.newsPost.Files.map((file, i) =>
										<div key={i} className="row">
											<div className="small-12 medium-6 columns">
												<label>News Post Image</label>
												{
													this.state.newPost.Files.length > 0 &&
													<img src={this.getImageUrl.call(this, file)} />
												}
											</div>
											<div className="small-12 medium-6 columns">
												<label className="required">Image Name</label>
												<h6>{this.state.newsPost.Files[i].name}</h6>
												{
													this.state.newsPost.Files[i].id &&
													<button className="button alert" onClick={this.handleDeleteFile.bind(this, this.state.newsPost.Files[i].id)}>Delete File?</button>
												}
											</div>
										</div>
									)
								}
							</Form>
						</fieldset>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-content text-center">
								<button className="button black small-12" onClick={this.handleSubmit} disabled={formIsInvalid}>{this.state.newNewsPost ? 'Create News Post' : 'Update News Post'}</button>
							</div>
						</div>
					</div>
				</div>
			</ViewWrapper>
		)
	}
}

export default connect(mapStateToProps, mapDispatchToProps)(EditNewsPostPage);
