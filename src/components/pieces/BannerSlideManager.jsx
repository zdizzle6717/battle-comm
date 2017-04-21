'use strict';

import React from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {AlertActions} from '../../library/alerts';
import Modal from '../../library/modal';
import {handlers, uploadFiles} from '../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox, FileUpload, getFormErrorCount} from '../../library/validations';
import FileService from '../../services/FileService';
import BannerSlideActions from '../../actions/BannerSlideActions';
import roleConfig from '../../../roleConfig';
import createAccessControl from '../../library/authentication/components/AccessControl';
const AccessControl = createAccessControl(roleConfig);

const mapStateToProps = (state) => {
	return {
		'slides': state.bannerSlides
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'getSlides': BannerSlideActions.getAll,
		'createSlide': BannerSlideActions.create,
		'deleteSlide': BannerSlideActions.remove,
		'updateSlide': BannerSlideActions.update
	}, dispatch);
}

class BannerSlideManager extends React.Component {
    constructor() {
        super();

		this.state = {
			'deleteSlideModalIsActive': false,
			'currentSlide': {
				'isActive': true
			},
			'files': [],
			'newFiles': [],
			'slidePendingDeletion': undefined
		}

		this.clearSlideForm = this.clearSlideForm.bind(this);
		this.nullifyCurrentSlide = this.nullifyCurrentSlide.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Admin Dashboard";
		this.props.getSlides().then((slides) => {
			let files = [];
			slides.forEach((slide) => {
				if (slide.File) {
					files.push([slide.File]);
				} else {
					files.push([]);
				}
			});
			this.setState({
				'files': files
			});
		});
    }

	clearSlideForm(e) {
		e.preventDefault();
		this.nullifyCurrentSlide();
	}

	editSlide(index) {
		let slide = this.props.slides[index]
		slide.index = index;
		this.setState({
			'currentSlide': slide
		});
	}

	handleDeleteSlide(e) {
		e.preventDefault();
		this.props.deleteSlide(this.state.slidePendingDeletion.id).then((slide) => {
			if (this.state.slidePendingDeletion.id === this.state.currentSlide.id) {
				this.nullifyCurrentSlide();
			}
			let files = this.state.files;
			FileService.remove(file[index].id).then(() => {
				files.splice(this.state.slidePendingDeletion.index, 1);
				this.showAlert('slideDeleted');
			});
		});
	}

	handleCheckBoxChange(e) {
		this.setState({
			'currentSlide': handlers.updateCheckBox(e, this.state.currentSlide)
		});
	}

	handleInputChange(e) {
		this.setState({
			'currentSlide': handlers.updateInput(e, this.state.currentSlide)
		});
	}

	handleFileUpload(files) {
		let currentSlide = this.state.currentSlide;
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
			newFiles = newFiles.concat(responses);
			this.setState({
				'newFiles': newFiles
			});
			this.showAlert('uploadSuccess');
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		let slide = this.state.currentSlide;
		let method = this.state.currentSlide.id ? 'updateSlide' : 'createSlide';
		this.props[method]((method === 'updateSlide' ? slide.id : slide), (method === 'updateSlide' ? slide : null)).then((slide) => {
			let newFiles = this.state.newFiles;
			if (newFiles.length > 0) {
				FileService.create({
					'BannerSlideId': slide.id,
					'identifier': 'bannerSlide',
					'locationUrl': 'bannerSlides/',
					'name': newFiles[0].name,
					'size': newFiles[0].size,
					'type': newFiles[0].type
				}).then((file) => {
					let files = this.state.files;
					if (files[this.state.currentSlide.index]) {
						files[this.state.currentSlide.index] = file
					} else {
						files.push(file);
					}
					this.setState({
						'files': files
					})
				});
			}
			this.setState({
				'newFiles': []
			});
			this.nullifyCurrentSlide();
			if (this.state.slide.id) {
				this.addAlert('slideUpdated');
			} else {
				this.addAlert('slideCreated');
			}
		});
	}

	nullifyCurrentSlide() {
		this.setState({
			'currentSlide': {
				'id': undefined,
				'title': undefined,
				'newSlides': []
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'slideCreated': () => {
				this.props.addAlert({
					'title': 'New Slide Created',
					'message': 'A new slide was successfully added to the homepage slideshow',
					'type': 'success',
					'delay': 3000
				});
			},
			'slideUpdated': () => {
				this.props.addAlert({
					'title': 'Slide Updated',
					'message': 'The current slide was successfully updated',
					'type': 'success',
					'delay': 3000
				});
			},
			'slideDeleted': () => {
				this.props.addAlert({
					'title': 'Slide Deleted',
					'message': 'The slide was successfully removed',
					'type': 'info',
					'delay': 3000
				});
			},
			'uploadSuccess': () => {
				this.props.addAlert({
					'title': 'Upload Success',
					'message': `New file successfully uploaded. Save form to complete transaction.`,
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

	toggleDeleteSlideModal(slide, index) {
		slide.index = index;
		this.setState({
			'slidePendingDeletion': slide,
			'deleteSlideModalIsActive': !this.state.deleteSlideModalIsActive
		});
	}

	uploadFiles(files) {
		return uploadFiles(files, '/files/add', 'bannerSlides/', {
			'identifier': 'bannerSlide'
		});
	}

    render() {
        return (
			<div className="row">
				<div className="row">
					<div className="small-12 columns">
						<table className="stack hover text-center">
							<thead>
								<tr>
									<th className="text-center">Priority</th>
									<th className="text-center">Title</th>
									<th className="text-center">Date Updated</th>
									<th className="text-center">Edit/Delete</th>
								</tr>
							</thead>
							<tbody>
								{
									this.props.slides.map((slide, i) =>
										<tr key={i}>
											<td>{slide.priority}</td>
											<td>{slide.title}</td>
											<td>{formatJSONDate(slide.updatedAt)}</td>
											<td>
												<div className="action-item">
													<span className="action" onClick={this.editSlide.bind(this, i)}>
														<i className="tip-icon fa fa-pencil"></i>
													</span>
													<span className="mobile-text">Edit</span>
												</div>
												<div className="action-item" >
													<span className="action" onClick={this.toggleDeleteSlideModal.bind(this, slide, i)}>
														<i className="tip-icon fa fa-times"></i>
													</span>
													<span className="mobile-text">Delete</span>
												</div>
											</td>
										</tr>
									)
								}
							</tbody>
						</table>
					</div>
				</div>
				<hr/>
				<h2>{this.state.currentSlide.id ? 'Edit Slide' : 'Add New Slide'}</h2>
				<div className="small-12 columns">
					<Form name="slideForm" submitText={this.state.currentSlide.id ? 'Update Slide' : 'Save New Slide'} handleSubmit={this.handleSubmit}>
						<div className="row">
							<div className="form-group small-12 medium-3 columns">
								<label className="required">Title</label>
								<Input type="text" name="title" value={this.state.currentSlide.title} handleInputChange={this.handleInputChange} required={true} />
							</div>
							<div className="form-group small-12 medium-2 columns">
								<label className="required">Priority (slide order)</label>
								<Input type="number" name="priority" value={this.state.currentSlide.priority} handleInputChange={this.handleInputChange} required={true} />
							</div>
							<div className="form-group small-12 medium-3 columns">
								<label className="required">Show in Slideshow?</label>
								<Select type="text" name="isActive" value={this.state.currentSlide.isActive} handleInputChange={this.handleInputChange} required={true}>
									<option value="true">Yes</option>
									<option value="false">No</option>
								</Select>
							</div>
							<div className="form-group small-12 medium-4 columns">
								<label className="required">Link</label>
								<Input type="text" name="link" value={this.state.currentSlide.link} handleInputChange={this.handleInputChange} required={true} />
							</div>
						</div>
						<div className="row">
							<div className="form-group small-12 medium-4 columns">
								<label className="required">Action Text</label>
								<Input type="text" name="title" value={this.state.currentSlide.title} handleInputChange={this.handleInputChange} required={true} />
							</div>
							<div className="form-group small-12 medium-8 columns">
								<label className="required">Callout Text</label>
								<TextArea type="text" name="text" value={this.state.currentSlide.text} handleInputChange={this.handleInputChange} rows="3" required={true}></TextArea>
							</div>
						</div>
						<div className="row">
							<div className="small-12 medium-4 columns">
								<label>Banner Image</label>
								{
									this.state.files[this.state.currentSlide.index].length > 0 && this.state.files[this.state.currentSlide.index][0].id &&
									<img src={`/uploads/${this.state.files[this.state.currentSlide.index][0].locationUrl}${this.state.files[this.state.currentSlide.index][0].name}`} />
								}
							</div>
							<div className="small-12 medium-4 columns">
								<label>Image Name</label>
								{
									this.state.files.length > 0 &&
									<h6>{this.state.files[this.state.currentSlide.index][0].name}</h6>
								}
								{
									this.state.files[this.state.currentSlide.index].length > 0 && this.state.files[this.state.currentSlide.index][0].id &&
									<button className="button alert" onClick={this.handleDeleteFile.bind(this, this.state.files[this.state.currentSlide.index][0].id)}>Delete File?</button>
								}
							</div>
							<div className="form-group small-12 medium-4 columns">
								<label>Upload File</label>
								<FileUpload name="slidePhoto" value={this.state.files[this.state.currentSlide.index]} handleFileUpload={this.handleFileUpload} handleDeleteFile={this.handleDeleteFile} hideFileList={true} accept="image/*" maxFiles={1} />
							</div>
						</div>
					</Form>
					<button className="button info" onClick={this.clearSlideForm}><span className="fa fa-plus"></span> Add New Slide</button>
				</div>
				<Modal name="deleteSlideModalIsActive" title="Delete Slide" modalIsOpen={this.state.deleteSlideModalIsActiveIsActive} handleClose={this.toggleDeleteSlideModal} showClose={true} handleSubmit={this.handleDeleteSlide} confirmText="Delete Permanently">
					Are you sure you want to delete this slide?
				</Modal>
			</div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(BannerSlideManager);
