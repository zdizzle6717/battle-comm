'use strict';

import React from 'react';
import {Link, withRouter} from 'react-router-dom';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import noUiSlider from 'nouislider';
import wNumb from 'wnumb';
import {PaginationControls} from '../../../library/pagination';
import ViewWrapper from '../../ViewWrapper';
import {CartActions} from '../../../library/cart';
import ProductActions from '../../../actions/ProductActions';
import ManufacturerService from '../../../services/ManufacturerService';

const mapStateToProps = (state) => {
    return {
		'cartQtyPlaceholders': state.cartQtyPlaceholders,
		'products': state.products
	}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addToCart': CartActions.add,
		'updateItemTotal': CartActions.update,
		'searchProducts': ProductActions.search
	}, dispatch);
};

let timer, priceSlider;
let _sliderStart = 0;
let _sliderEnd = 10000;

class Store extends React.Component {
    constructor() {
        super();

		this.state = {
			'orderBy': 'updatedAt',
			'pagination': {},
			'pageSize': 15,
			'qtyPlaceholders': {},
			'searchQuery': '',
			'sliderStart': _sliderStart,
			'sliderEnd': _sliderEnd,
			'selectedManufacturer': '',
			'manufacturers': []
		}

		this.handleFilterReset = this.handleFilterReset.bind(this);
		this.handleGameSystemChange = this.handleGameSystemChange.bind(this);
		this.handleManufacturerChange = this.handleManufacturerChange.bind(this);
		this.handleOrderChange = this.handleOrderChange.bind(this);
		this.handlePageChange = this.handlePageChange.bind(this);
		this.handlePageSizeChange = this.handlePageSizeChange.bind(this);
		this.handleQueryChange = this.handleQueryChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Store";
		ManufacturerService.getAll().then((manufacturers) => {
			this.setState({
				'manufacturers': manufacturers
			})
		});
		this.handlePageChange(1);

		priceSlider = document.getElementById('price-slider');
		noUiSlider.create(priceSlider, {
			'start': [_sliderStart, _sliderEnd],
			'behaviour': 'tap-drag',
			'connect': [false, true, false],
			'gameSystems': [],
			'step': 1,
			'range': {
				'min': _sliderStart,
				'max': _sliderEnd
			},
			'format': wNumb({
				'decimals': 0,
				'thousand': ','
			})
		});

		priceSlider.noUiSlider.on('update', (values, handle) => {
			this.setState({
				'sliderStart': values[0],
				'sliderEnd': values[1]
			});
		});

		priceSlider.noUiSlider.on('end', (values, handle) => {
			let bottom = values[0];
			let top = values[1];
			bottom = bottom.replace(/\,/g, '');
			bottom = parseInt(bottom, 10);
			top = top.replace(/\,/g, '');
			top = parseInt(top, 10);
			this.handlePageChange(1, bottom, top);
		});
    }

	componentWillReceiveProps(nextProps) {
		// TODO: Improve logic so this doesn't get called too often
		this.setState({
			'qtyPlaceholders': Object.assign({}, nextProps.cartQtyPlaceholders)
		});
	}

	componentWillUnmount() {
		if (timer) {
			clearTimeout(timer);
		}
		priceSlider.noUiSlider.off();
	}

	addToCart(product, e) {
		if (e) {
			e.preventDefault();
		}
		let quantity = 1;
		if (this.state.qtyPlaceholders[product.id]) {
			quantity = this.state.qtyPlaceholders[product.id] > 0 ? this.state.qtyPlaceholders[product.id] : 1;
		}
		if (this.state.qtyPlaceholders[product.id] !== '') {
			this.props.addToCart(product, quantity);
		}
	}

	getProductImage(side, product) {
		let image;
        if (!product.Files || product.Files.length < 1) {
            return '/uploads/rpStore/defaultImage.jpg';
        }
		if (side === 'front') {
			image = product.Files.filter(file => file.identifier === 'productPhotoFront');
		} else if (side === 'back') {
			image = product.Files.filter(file => file.identifier === 'productPhotoBack');
		}
		return image[0].locationUrl + image[0].name;
	}

	handleFilterReset() {
		this.setState({
			'pageSize': 20,
			'orderBy': 'updatedAt',
			'searchQuery': '',
			'sliderStart': _sliderStart,
			'sliderEnd': _sliderEnd
		}, () => {
			priceSlider.noUiSlider.reset();
			this.handlePageChange(1);
		});
	}

	handleGameSystemChange(e) {
		let id = e.target.value;
		this.setState({
			'selectedGameSystem': id ? id : ''
		}, () => {
			this.handlePageChange(1);
		});
	}

	handleManufacturerChange(e) {
		let id = e.target.value;
		let gameSystems = [];
		if (id) {
			let manufacturer = this.state.manufacturers.find((manufacturer) => manufacturer.id == id);
			gameSystems = manufacturer.GameSystems;
		}
		this.setState({
			'selectedManufacturer': id ? id : '',
			'gameSystems': gameSystems,
			'selectedGameSystem': ''
		}, () => {
			this.handlePageChange(1);
		});
	}

	handleOrderChange(e) {
		this.setState({
			'orderBy': e.target.value
		}, () => {
			this.handlePageChange(1);
		});
	}

	handlePageChange(pageNumber = 1, minPrice = _sliderStart, maxPrice = _sliderEnd) {
        this.props.searchProducts({'pageNumber': pageNumber, 'searchQuery': this.state.searchQuery, 'orderBy': this.state.orderBy, 'pageSize': this.state.pageSize, 'minPrice': minPrice, 'maxPrice': maxPrice, 'manufacturerId': this.state.selectedManufacturer, 'gameSystemId': this.state.selectedGameSystem, 'storeView': true}).then((pagination) => {
			this.setState({
				'pagination': pagination
			});
        });
    }

	handlePageSizeChange(e) {
		this.setState({
			'pageSize': e.target.value
		}, () => {
			this.handlePageChange(1);
		});
	}

	handleQuantityChange(productId, e) {
		e.preventDefault();
		let value = e.target.value;
		if (value === '' || (!isNaN(value) && value % 1 === 0)) {
			let qtyPlaceholders = this.state.qtyPlaceholders;
			qtyPlaceholders[productId] = value;
			this.setState({
				'qtyPlaceholders': qtyPlaceholders
			});
		}
	}

	handleQueryChange(e) {
		if (timer) {
			clearTimeout(timer);
		}
		this.setState({
			'searchQuery': e.target.value
		}, () => {
			timer = setTimeout(() => {
				this.handlePageChange(1);
			}, 500);
		});
	}

	updateItemTotal(product, e) {
		if (e) {
			e.preventDefault();
		}
		let quantity = 0;
		if (this.state.qtyPlaceholders[product.id]) {
			quantity = this.state.qtyPlaceholders[product.id];
		}
		if (this.state.qtyPlaceholders[product.id] !== '') {
			this.props.updateItemTotal(product, quantity);
		}
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Store.png" headerAlt="Store">
				<div className="row product-listing">
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Search Filter
							</div>
							<div className="panel-content">
								<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Begin typing to filter results"/>
							</div>
						</div>
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Manufacturer
							</div>
							<div className="panel-content">
								<select name="selectedManufacturer" onChange={this.handleManufacturerChange} value={this.state.selectedManufacturer}>
									<option value="">All Manufacturers</option>
									{
										this.state.manufacturers.map((manufacturer) =>
											<option key={manufacturer.id} value={manufacturer.id}>{manufacturer.name}</option>
										)
									}
								</select>
							</div>
						</div>
						{
							this.state.selectedManufacturer &&
							<div className="panel push-bottom-2x">
								<div className="panel-title color-black">
									Game System
								</div>
								<div className="panel-content">
									<select name="selectedManufacturer" onChange={this.handleGameSystemChange} value={this.state.selectedGameSystem}>
										<option value="">All Systems</option>
										{
											this.state.gameSystems.map((gameSystem) =>
												<option key={gameSystem.id} value={gameSystem.id}>{gameSystem.name}</option>
											)
										}
									</select>
								</div>
							</div>
						}
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Price Filter
							</div>
							<div className="panel-content">
								<div id="price-slider"></div>
								<div className="price-labels">
									<span>{this.state.sliderStart} RP</span>
									<span>{this.state.sliderEnd} RP</span>
								</div>
							</div>
						</div>
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Order By
							</div>
							<div className="panel-content">
								<select name="orderBy" onChange={this.handleOrderChange} value={this.state.orderBy}>
									<option value="createdAt">Created Date</option>
									<option value="updatedAt">Last Updated</option>
									<option value="name">Product Name</option>
									<option value="price">Product Price</option>
								</select>
							</div>
						</div>
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Items Per Page
							</div>
							<div className="panel-content">
								<select name="pageSize" onChange={this.handlePageSizeChange} value={this.state.pageSize}>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>
							</div>
						</div>
						<div className="panel push-bottom-2x">
							<div className="panel-title color-black">
								Reset Search Filters
							</div>
							<div className="panel-content text-center">
								<button className="button black small-12" onClick={this.handleFilterReset}><span className="fa fa-refresh"> </span>Reset</button>
							</div>
						</div>
					</div>
					<div className="small-12 medium-8 large-9 columns">
						<div className="products-container">
							{
								this.props.products.map((product, i) =>
								<div key={product.id} className="product-box">
									<div className="flip-container">
										<Link to={`/store/products/${product.id}`} className="flipper">
											<div className="front">
												<img src={this.getProductImage.call(this, 'front', product)} alt={product.name} />
											</div>
											<div className="back">
												<img src={this.getProductImage.call(this, 'back', product)} alt={product.name}/>
											</div>
										</Link>
									</div>
									<div className="product-details">
										<div className="product-name text-center">
											<Link to={`/store/products/${product.id}`}>{product.name}</Link>
										</div>
										<div className="price text-center">
											<strong>{product.price} RP</strong>
										</div>
										<div className="small-12 columns select-qty">
											{
												(this.state.qtyPlaceholders[product.id] === undefined || (this.state.qtyPlaceholders[product.id] < 5 && this.state.qtyPlaceholders[product.id] !== '')) &&
												<select value={this.state.qtyPlaceholders[product.id]} onChange={this.handleQuantityChange.bind(this, product.id)}>
													<option value={0}>0</option>
													<option value={1}>1</option>
													<option value={2}>2</option>
													<option value={3}>3</option>
													<option value={4}>4</option>
													<option value={5}>More...</option>
												</select>
											}
											{
												(this.state.qtyPlaceholders[product.id] >= 5 || this.state.qtyPlaceholders[product.id] === '') &&
												<input type="number" value={this.state.qtyPlaceholders[product.id]} onChange={this.handleQuantityChange.bind(this, product.id)} step="1"/>
											}
										</div>
										<div className={this.props.cartQtyPlaceholders[product.id] >= 1 ? 'small-12 columns actions text-center in-cart' : 'small-12 columns actions text-center'}>
											{
												(this.props.cartQtyPlaceholders[product.id] >= 1 || this.props.cartQtyPlaceholders[product.id] === '') ?
												<button className="button secondary" onClick={this.updateItemTotal.bind(this, product)}>Update Total</button> :
												<button className="button primary" onClick={this.addToCart.bind(this, product)}>Add To Cart</button>
											}
											<Link className="button black" to={`/store/products/${product.id}`}>More Details</Link>
										</div>
									</div>
								</div>
								)
							}
						</div>
					</div>
				</div>
				<div className="row">
					<div className="small-12 columns">
						<PaginationControls pageNumber={this.state.pagination.pageNumber} pageSize={this.state.pagination.pageSize} totalPages={this.state.pagination.totalPages} totalResults={this.state.pagination.totalResults} handlePageChange={this.handlePageChange.bind(this)}></PaginationControls>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Store));
