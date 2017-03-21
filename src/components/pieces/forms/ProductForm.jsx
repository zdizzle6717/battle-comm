'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Form, Input, TextArea, Select, CheckBox} from '../../../library/validations';
import {handlers, uploadFiles} from '../../../library/utilities';
import {AlertActions} from '../../../library/alerts';
import ManufacturerActions from '../../../actions/ManufacturerActions';
import FileService from '../../../services/FileService';
import GameSystemService from '../../../services/GameSystemService';
import ManufacturerService from '../../../services/ManufacturerService';
import ProductService from '../../../services/ProductService';

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

class ProductForm extends React.Component {
	constructor() {
		this.state = {
			'product': {
				'Files': []
			},
			'newProduct': false,
			'newFiles': [],
			'gameSystems': [],
			'factions': []
		}

		this.getDirectoryPath = this.getDirectoryPath.bind(this);
		this.showAlert = this.showAlert.bind(this);
		this.handleManufacturerChange = this.handleManufacturerChange.bind(this);
		this.handleGameSystemChange = this.handleGameSystemChange.bind(this);
		this.handleFileUpload = this.handleFileUpload.bind(this);
		this.uploadFiles = this.uploadFiles.bind(this);
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
	}

	componentDidMount() {
		this.props.getManufacturers();
		if (this.props.productId) {
			ProductService.get(this.props.productId).then((product) => {
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

	uploadFiles(files) {
		let directoryPath = this.getDirectoryPath();
		return uploadFiles(files, '/files/add', directoryPath, {
			'identifier': 'productPhoto'
		});
	}

	getDirectoryPath() {
		let year = new Date();
		year = year.getFullYear();
		return `rpstore/${this.state.product.sku}/`;
	}

	hanldeSubmit() {
		let post = this.state.product;
		let method = this.props.productId ? 'update' : 'create';
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
			if (this.props.productId) {
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
			}
		}

		return alerts[selector]();
	}

	render() {
		<div>
			<Form name="productForm" submitText={this.state.newProduct ? 'Create News Post' : 'Update News Post'} handleSubmit={this.hanldeSubmit}>
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
						<label className="required">Callout</label>
						<TextArea type="text" name="callout" value={this.state.product.callout} rows="4" handleInputChange={this.handleInputChange} required={true} />
					</div>
					<div className="form-group small-12 medium-4 columns">
						<label className="required">Body</label>
						<TextArea type="text" name="body" value={this.state.product.body} rows="7" handleInputChange={this.handleInputChange} required={true} />
					</div>
					<div className="form-group small-12 medium-4 columns">
						<label className="required">Tags</label>
						<TextArea type="text" name="tags" value={this.state.product.tags} rows="4" handleInputChange={this.handleInputChange} required={true} />
					</div>
				</div>
				<div className="row">
					<div className="form-group small-12 medium-4 columns">
						<label className="required">News Post Photos</label>
						<FileUpload name="postPhotos" value={this.state.product.Files} handleFileUpload={this.handleFileUpload} maxFiles={5} required={1} disabled={!this.state.product.sku}/>
					</div>
				</div>
			</Form>
		</div>
	}
}

ProductForm.propTypes = {
	'productId': React.PropTypes.number
}

ProductForm.defaultProps = {
}

export default connect(mapStateToProps, mapDispatchToProps)(ProductForm);
