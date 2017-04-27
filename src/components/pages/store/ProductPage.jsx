'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import CartActions from '../../../actions/CartActions';
import ViewWrapper from '../../ViewWrapper';
import ProductService from '../../../services/ProductService';

const mapStateToProps = (state) => {
    return {
		'cartQtyPlaceholders': state.cartQtyPlaceholders
	}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addToCart': CartActions.add,
		'updateItemTotal': CartActions.update
	}, dispatch);
};

class ProductPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'product': {
				'Files': []
			},
			'qtyPlaceholders': {}
		}

		this.getImageFront = this.getImageFront.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Product";
		if (!this.props.params.productId) {
			browserHistory.push('/products');
		} else {
			ProductService.get(this.props.params.productId).then((product) => {
				this.setState({
					'product': product,
					'qtyPlaceholders': Object.assign({}, this.props.cartQtyPlaceholders)
				});
			});
		}
    }

	componentWillReceiveProps(nextProps) {
		// TODO: Improve logic so this doesn't get called too often
		console.log(nextProps.cartQtyPlaceholders);
		this.setState({
			'qtyPlaceholders': Object.assign({}, nextProps.cartQtyPlaceholders)
		});
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

	getImageFront() {
		let file = this.state.product.Files.find((file) => {
			return file.identifier = 'productPhotoFront';
		});

		if (file) {
			return `/uploads/${file.locationUrl}${file.name}`;
		} else {
			return false;
		}
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
		let product = this.state.product;
        return (
            <ViewWrapper headerImage="/images/Titles/Product_Details.png" headerAlt="Product Details">
				<div className="product-details">
					<div className="row">
						<div className="small-12 columns">
							<h1 className="ribbon">Product {product.name}</h1>
						</div>
						<hr />
	                </div>
					<div className="row">
						<div className="small-12 medium-8 large-9 columns">
							<div className="small-12 medium-6 columns">
								{
									this.getImageFront() &&
									<img src={this.getImageFront()} />
								}
							</div>
							<div className="small-12 medium-6 columns">
								<h3><strong>Product Description</strong></h3>
								<p>{product.description}</p>
							</div>
						</div>
						<div className="small-12 medium-4 large-3 columns">
							<div className="panel push-bottom-2x push-top">
								<div className="panel-title color-black">
									Item Actions
								</div>
								<div className="panel-content">
									<h3 className="text-center">{product.price} RP</h3>
									<label>Quantity</label>
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
									<div className="row">
										<div className={this.props.cartQtyPlaceholders[product.id] >= 1 ? 'small-12 columns actions text-center in-cart' : 'small-12 columns actions text-center'}>
											{
												(this.props.cartQtyPlaceholders[product.id] >= 1 || this.props.cartQtyPlaceholders[product.id] === '') ?
												<button className="button secondary" onClick={this.updateItemTotal.bind(this, product)}>Update Total</button> :
												<button className="button primary" onClick={this.addToCart.bind(this, product)}>Add To Cart</button>
											}
											<Link className="button black" to={`store/products/${product.id}`}>More Details</Link>
										</div>
									</div>
								</div>
							</div>
							<div className="panel push-bottom-2x push-top">
								<div className="panel-content text-center">
									<Link to="/store/cart" className="button primary small-12">Review Cart</Link>
									<Link to="/store/checkout" className="button secondary small-12 collapse">Go to Checkout</Link>
								</div>
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ProductPage);
