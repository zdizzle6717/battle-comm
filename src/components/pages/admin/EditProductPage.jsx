'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {browserHistory, Link} from 'react-router';
import {AlertActions} from '../../../library/alerts';
import {handlers, uploadFiles} from '../../../library/utilities';
import {Form, Input, TextArea, Select, CheckBox} from '../../../library/validations';
import ViewWrapper from '../../ViewWrapper';
import FileService from '../../../services/FileService';
import GameSystemService from '../../../services/GameSystemService';
import ManufacturerActions from '../../../actions/ManufacturerActions';
import ManufacturerService from '../../../services/ManufacturerService';
import ProductService from '../../../services/ProductService';
import AdminMenu from '../../pieces/AdminMenu';

const mapStateToProps = (state) => {
	return {
		'manufacturers': state.manufacturers
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addAlert': AlertActions.addAlert,
		'getManufacturers': ManufacturerActions.getAll
	}, dispatch);
}

class EditProductPage extends React.Component {
	constructor() {
		super();

		this.state = {
			'factions': [],
			'gameSystems': [],
			'newFiles': [],
			'newProduct': false,
			'product': {
				'Files': []
			}
		}

		this.getDirectoryPath = this.getDirectoryPath.bind(this);
		this.handleDeleteFile = this.handleDeleteFile.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.handleGameSystemChange = this.handleGameSystemChange.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleManufacturerChange = this.handleManufacturerChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.uploadFiles = this.uploadFiles.bind(this);
	}

	componentDidMount() {
		document.title = "Battle-Comm | Product Edit";
		this.props.getManufacturers();
		if (this.props.params.productId) {
			ProductService.get(this.props.params.productId).then((product) => {
				this.setState({
					'product': product
				});
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
		return `rpstore/${this.state.product.sku}/`;
	}

	handleDeleteFile(fileId) {
		FileService.remove(fileId).then(() => {
			this.showAlert('fileRemoved');
		});
	}

	handleFileUpload(files) {
		let product = this.state.product;
		let newFiles = this.state.newFiles;
		this.uploadFiles(files).then((responses) => {
			responses = responses.map((response, i) => {
				response = {
					'name': response.data.file.name,
					'size': response.data.file.size,
					'type': response.data.file.type
				};
				return response;
			});
			let newFileList = responses.concat(product.Files);
			product.Files = newFileList;
			newFiles = newFiles.concat(responses);
			this.setState({
				'product': product,
				'newFiles': newFiles
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

	handleSubmit() {
		let post = this.state.product;
		let method = this.props.params.productId ? 'update' : 'create';
		post.UserId = this.props.playerId;
		ProductService[method]((method === 'update' ? post.id : post), (method === 'update' ? post : null)).then((product) => {
			let directoryPath = this.getDirectoryPath();
			let newFiles = this.state.newFiles;
			if (newFiles.length > 0) {
				newFiles.forEach((file, i) => {
					FileService.create({
						'ProductId': product.id,
						'identifier': 'productPhoto',
						'locationUrl': `${directoryPath}/${file[i].name}`,
						'name': file[i].name,
						'size': file[i].size,
						'type': file[i].type
					})
				});
			}
			this.setState({
				'product': product
			});
			if (this.props.params.productId) {
				this.addAlert('productUpdated');
				browserHistory.push('/admin');
			} else {
				this.addAlert('productCreated');
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
			}
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
		<ViewWrapper>
			<div className="small-12 columns">
				<h1>Product Edit</h1>
				<hr/>
				<AdminMenu></AdminMenu>
				<hr/>
			</div>
			<div className="row">
				<div className="small-12 medium-8 large-9 columns">
					<Form name="productForm" submitText={this.state.newProduct ? 'Create News Post' : 'Update News Post'} handleSubmit={this.handleSubmit}>
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
								<Input type="text" name="sku" value={this.state.product.sku} handleInputChange={this.handleInputChange} required={true} />
							</div>
						</div>
						<div className="row">
							<div className="form-group small-12 medium-4 columns">
								<label>Manufacturer</label>
								<Select name="ManufacturerId" value={this.state.product.ManufacturerId} handleInputChange={this.handleManufacturerChange}>
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
								<Select name="GameSystemId" value={this.state.product.GameSystemId} handleInputChange={this.handleGameSystemChange}>
									<option value="">--Select--</option>
									{
										this.state.gameSystems.map((gameSystems, i) =>
											<option key={i} value={gameSystems.id}>{gameSystems.name}</option>
										)
									}
								</Select>
							</div>
							<div className="form-group small-12 medium-4 columns">
								<label>Faction</label>
								<Select name="FactionId" value={this.state.product.FactionId} handleInputChange={this.handleInputChange}>
									<option value="">--Select--</option>
									{
										this.state.factions.map((factions, i) =>
											<option key={i} value={factions.id}>{factions.name}</option>
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
								<label className="required">Color</label>
								<Input type="text" name="color" value={this.state.product.color} handleInputChange={this.handleInputChange} required={true} />
							</div>
							<div className="form-group small-12 medium-4 columns">
								<label className="required">Category</label>
								<Input type="text" name="category" value={this.state.product.category} handleInputChange={this.handleInputChange} required={true} />
							</div>
						</div>
						<div className="row">
							<div className="form-group small-12 medium-4 columns">
								<CheckBox name="inStock" value={this.state.product.inStock} handleInputChange={this.handleCheckBoxChange} label="In Stock?"/>
							</div>
							<div className="form-group small-12 medium-4 columns">
								<CheckBox name="displayStatus" value={this.state.product.displayStatus} handleInputChange={this.handleCheckBoxChange} label="Display In Store?"/>
							</div>
							<div className="form-group small-12 medium-4 columns">
								<label>Display Value</label>
								<Select name="filterVal" value={this.state.product.filterVal} handleInputChange={this.handleInputChange}>
									<option value="showIt">Show It</option>
									<option value="hideIt">Hide It</option>
								</Select>
							</div>
						</div>
						<div className="row">
							<div className="form-group small-12 medium-4 columns">
								<CheckBox name="new" value={this.state.product.new} handleInputChange={this.handleCheckBoxChange} label="New Product?"/>
							</div>
							<div className="form-group small-12 medium-4 columns">
								<CheckBox name="featured" value={this.state.product.featured} handleInputChange={this.handleCheckBoxChange} label="Featured Product?"/>
							</div>
							<div className="form-group small-12 medium-4 columns">
								<CheckBox name="onSale" value={this.state.product.onSale} handleInputChange={this.handleCheckBoxChange} label="On Sale?"/>
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
						<div className="row">
							<div className="form-group small-12 medium-4 columns">
								<label className="required">Product Images</label>
								<FileUpload name="productPhoto" value={this.state.product.Files} handleFileUpload={this.handleFileUpload} handleDeleteFile={handleDeleteFile} maxFiles={5} required={1} disabled={!this.state.product.sku}/>
							</div>
						</div>
					</Form>
				</div>
				<div className="small-12 medium-4 large-3 columns">
					Filters
				</div>
			</div>
		</ViewWrapper>
	}
}

export default connect(mapStateToProps, mapDispatchToProps)(EditProductPage);
