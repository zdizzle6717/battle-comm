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
import GameSystemService from '../../../services/GameSystemService';
import ManufacturerActions from '../../../actions/ManufacturerActions';
import ManufacturerService from '../../../services/ManufacturerService';
import ProductService from '../../../services/ProductService';
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

class EditProduct extends React.Component {
	constructor() {
		super();

		this.state = {
			'factions': [],
			'gameSystems': [],
			'newFiles': [],
			'newProduct': false,
			'product': {
				'Files': []
			},
			'productPhotoFront': [],
			'productPhotoBack': [],
			'skuIsDisabled': false
		}

		this.getDirectoryPath = this.getDirectoryPath.bind(this);
		this.handleDeleteFile = this.handleDeleteFile.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.handleGameSystemChange = this.handleGameSystemChange.bind(this);
		this.handleCheckBoxChange = this.handleCheckBoxChange.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleManufacturerChange = this.handleManufacturerChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.uploadFiles = this.uploadFiles.bind(this);
	}

	componentDidMount() {
		document.title = "Battle-Comm | Product Edit";
		this.props.getManufacturers();
		if (this.props.match.params.productId) {
			ProductService.get(this.props.match.params.productId).then((product) => {
				let productPhotoFront = product.Files.filter((file) => {
					return file.identifier === 'productPhotoFront'
				});
				let productPhotoBack = product.Files.filter((file) => {
					return file.identifier === 'productPhotoBack'
				});
				this.setState({
					'product': product,
					'productPhotoFront': productPhotoFront,
					'productPhotoBack': productPhotoBack,
					'skuIsDisabled': true
				});
				if (product.ManufacturerId) {
					ManufacturerService.get(product.ManufacturerId).then((manufacturer) => {
						this.setState({
							'gameSystems': manufacturer.GameSystems
						});
						if (product.GameSystemId) {
							GameSystemService.get(product.GameSystemId).then((gameSystem) => {
								this.setState({
									'factions': gameSystem.Factions
								});
							});
						}
					});
				}
			});
		} else {
			this.setState({
				'newProduct': true
			})
		}
	}

	getDirectoryPath() {
		let year = new Date();
		year = year.getFullYear();
		return `rpstore/${this.state.product.SKU}/`;
	}

	handleDeleteFile(fileId, e) {
		if (e) {
			e.preventDefault();
		}
		FileService.remove(fileId).then(() => {
			this.showAlert('fileRemoved');
		}).catch((error) => {
			console.log(error);
		});
	}

	handleFileUpload(identifier, files) {
		let product = this.state.product;
		let newFiles = this.state.newFiles;
		this.uploadFiles(files).then((responses) => {
			responses = responses.map((response, i) => {
				response = {
					'name': response.data.file.name,
					'size': response.data.file.size,
					'type': response.data.file.type,
					'locationUrl': this.getDirectoryPath(),
					'identifier': identifier
				};
				return response;
			});
			let newFileList = responses.concat(product.Files);
			product.Files = newFileList;
			newFiles = newFiles.concat(responses);
			let productPhotoFront = identifier === 'productPhotoFront' ? responses : this.state.productPhotoFront;
			let productPhotoBack = identifier === 'productPhotoBack' ? responses : this.state.productPhotoBack;
			this.setState({
				'product': product,
				'newFiles': newFiles,
				'skuIsDisabled': true,
				'productPhotoFront': productPhotoFront,
				'productPhotoBack': productPhotoBack
			});
			this.showAlert('uploadSuccess');
		});
	}

	handleGameSystemChange(e) {
		let product = this.state.product;
		product.GameSystemId = e.target.value;
		product.FactionId = undefined;
		GameSystemService.get(e.target.value).then((gameSystem) => {
			this.setState({
				'product': product,
				'factions': gameSystem.Factions
			});
		});
	}

	handleCheckBoxChange(e) {
		this.setState({
			'product': handlers.updateCheckBox(e, this.state.product)
		});
	}

	handleInputChange(e) {
		this.setState({
			'product': handlers.updateInput(e, this.state.product)
		});
	}

	handleManufacturerChange(e) {
		let product = this.state.product;
		product.ManufacturerId = e.target.value;
		product.GameSystemId = undefined;
		product.FactionId = undefined;
		ManufacturerService.get(e.target.value).then((manufacturer) => {
			this.setState({
				'product': product,
				'gameSystems': manufacturer.GameSystems
			});
		});
	}

	handleSubmit(e) {
		e.preventDefault();
		let post = this.state.product;
		let method = this.props.match.params.productId ? 'update' : 'create';
		post.UserId = this.props.playerId;
		ProductService[method]((method === 'update' ? post.id : post), (method === 'update' ? post : null)).then((product) => {
			let directoryPath = this.getDirectoryPath();
			let newFiles = this.state.newFiles;
			if (newFiles.length > 0) {
				newFiles.forEach((file, i) => {
					FileService.create({
						'ProductId': product.id,
						'identifier': file.identifier,
						'locationUrl': `${directoryPath}`,
						'name': file.name,
						'size': file.size,
						'type': file.type
					});
				});
			}
			this.setState({
				'product': product
			});
			if (this.props.match.params.productId) {
				this.showAlert('productUpdated');
				this.props.history.push('/admin/products');
			} else {
				this.showAlert('productCreated');
			}
		});
	}

	showAlert(selector) {
		const alerts = {
			'productCreated': () => {
				this.props.addAlert({
					'title': 'News Product Created',
					'message': `New product, ${this.state.product.name}, successfully created.`,
					'type': 'success',
					'delay': 3000
				});
			},
			'productUpdated': () => {
				this.props.addAlert({
					'title': 'Product Updated',
					'message': `Product, ${this.state.product.name}, was successfully updated.`,
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
			},
			'uploadSuccess': () => {
				this.props.addAlert({
					'title': 'Upload Success',
					'message': `Files were successfully uploaded.`,
					'type': 'success',
					'delay': 3000
				});
			},
		}

		return alerts[selector]();
	}

	uploadFiles(files) {
		let directoryPath = this.getDirectoryPath();
		return uploadFiles(files, '/files/add', directoryPath, {
			'identifier': 'productPhoto'
		});
	}

	render() {
		let formIsValid = getFormErrorCount(this.props.forms, 'productForm') < 1;

		return (
			<ViewWrapper headerImage="/images/Titles/Product_Edit.png" headerAlt="Product Edit">
				<div className="small-12 columns">
					<hr/>
					<AdminMenu></AdminMenu>
					<hr/>
				</div>
				<div className="row">
					<div className="small-12 columns">
						<h2>{this.state.newProduct ? 'Create New Product' : `${this.state.product.name}`}</h2>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<fieldset>
							<Form name="productForm" submitButton={false}>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Name</label>
										<Input type="text" name="name" value={this.state.product.name} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Price</label>
										<Input type="number" name="price" value={this.state.product.price} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">SKU</label>
										<Input type="text" name="SKU" value={this.state.product.SKU} handleInputChange={this.handleInputChange} disabled={this.state.skuIsDisabled} required={true} />
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label>Manufacturer</label>
										<Select name="ManufacturerId" value={this.state.product.ManufacturerId} handleInputChange={this.handleManufacturerChange}>
											<option value="">--Select--</option>
											{
												this.props.manufacturers.map((manufacturer, i) =>
													<option key={manufacturer.id} value={manufacturer.id}>{manufacturer.name}</option>
												)
											}
										</Select>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Game System</label>
										<Select name="GameSystemId" value={this.state.product.GameSystemId} handleInputChange={this.handleGameSystemChange}>
											<option value="">--Select--</option>
											{
												this.state.gameSystems.map((gameSystem, i) =>
													<option key={gameSystem.id} value={gameSystem.id}>{gameSystem.name}</option>
												)
											}
										</Select>
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Faction</label>
										<Select name="FactionId" value={this.state.product.FactionId} handleInputChange={this.handleInputChange}>
											<option value="">--Select--</option>
											{
												this.state.factions.map((faction, i) =>
													<option key={faction.id} value={faction.id}>{faction.name}</option>
												)
											}
										</Select>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Stock Qty</label>
										<Input type="number" name="stockQty" value={this.state.product.stockQty} handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label>Color</label>
										<Input type="text" name="color" value={this.state.product.color} handleInputChange={this.handleInputChange} />
									</div>
									<div className="form-group small-12 medium-4 columns">
										<label className="required">Category</label>
										<Input type="text" name="category" value={this.state.product.category} handleInputChange={this.handleInputChange} required={true} />
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-3 columns">
										<CheckBox name="isDisplayed" value={this.state.product.isDisplayed} handleInputChange={this.handleCheckBoxChange} label="Display In Store?"/>
									</div>
									<div className="form-group small-12 medium-3 columns">
										<CheckBox name="isNew" value={this.state.product.isNew} handleInputChange={this.handleCheckBoxChange} label="New Product?"/>
									</div>
									<div className="form-group small-12 medium-3 columns">
										<CheckBox name="isFeatured" value={this.state.product.isFeatured} handleInputChange={this.handleCheckBoxChange} label="Featured Product?"/>
									</div>
									<div className="form-group small-12 medium-3 columns">
										<CheckBox name="isOnSale" value={this.state.product.isOnSale} handleInputChange={this.handleCheckBoxChange} label="On Sale?"/>
									</div>
								</div>
								<div className="row">
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Description</label>
										<TextArea type="text" name="description" value={this.state.product.description} rows="5" handleInputChange={this.handleInputChange} required={true} />
									</div>
									<div className="form-group small-12 medium-6 columns">
										<label className="required">Tags</label>
										<TextArea type="text" name="tags" value={this.state.product.tags} handleInputChange={this.handleInputChange} required={true} />
									</div>
								</div>
								<fieldset>
									<div className="row">
										<div className="small-12 medium-4 columns">
											<label className="required">Featured Image (front)</label>
											{
												this.state.productPhotoFront.length > 0 &&
												<img src={`/uploads/${this.state.productPhotoFront[0].locationUrl}${this.state.productPhotoFront[0].name}`} />
											}
										</div>
										<div className="small-12 medium-4 columns">
											<label className="required">Image Name</label>
											{
												this.state.productPhotoFront.length > 0 &&
												<h6>{this.state.productPhotoFront[0].name}</h6>
											}
											{
												this.state.productPhotoFront.length > 0 && this.state.productPhotoFront[0].id &&
												<button className="button alert" onClick={this.handleDeleteFile.bind(this, this.state.productPhotoFront[0].id)}>Delete File?</button>
											}
										</div>
										<div className="form-group small-12 medium-4 columns">
											<FileUpload name="productPhotoFront" value={this.state.productPhotoFront} handleFileUpload={this.handleFileUpload.bind(this, 'productPhotoFront')} handleDeleteFile={this.handleDeleteFile} maxFiles={1} required={1} hideFileList={true} accept="image/*" disabled={!this.state.product.SKU || this.state.productPhotoFront.length > 0}/>
										</div>
									</div>
									<hr />
									<div className="row">
										<div className="small-12 medium-4 columns">
											<label className="required">Featured Image (back)</label>
											{
												this.state.productPhotoBack.length > 0 &&
												<img src={`/uploads/${this.state.productPhotoBack[0].locationUrl}${this.state.productPhotoBack[0].name}`} />
											}
										</div>
										<div className="small-12 medium-4 columns">
											<label className="required">Image Name</label>
											{
												this.state.productPhotoBack.length > 0 &&
												<h6>{this.state.productPhotoBack[0].name}</h6>
											}
											{
												this.state.productPhotoBack.length > 0 && this.state.productPhotoBack[0].id &&
												<button className="button alert" onClick={this.handleDeleteFile.bind(this, this.state.productPhotoBack[0].id)}>Delete File?</button>
											}
										</div>
										<div className="form-group small-12 medium-4 columns">
											<FileUpload name="productPhotoBack" value={this.state.productPhotoBack} handleFileUpload={this.handleFileUpload.bind(this, 'productPhotoBack')} handleDeleteFile={this.handleDeleteFile} maxFiles={1} required={1} hideFileList={true} accept="image/*" disabled={!this.state.product.SKU || this.state.productPhotoBack.length > 0}/>
										</div>
									</div>
								</fieldset>
							</Form>
						</fieldset>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-content text-center">
								<button className="button black small-12" onClick={this.handleSubmit} disabled={!formIsValid}>{this.state.newProduct ? 'Create Product' : 'Update Product'}</button>
							</div>
						</div>
					</div>
				</div>
			</ViewWrapper>
		)
	}
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(EditProduct));
