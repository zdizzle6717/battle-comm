'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import CartActions from '../../../actions/CartActions';
import ProductActions from '../../../actions/ProductActions';

const mapStateToProps = (state) => {
    return {
		'products': state.products
	}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addToCart': CartActions.add,
		'searchProducts': ProductActions.search
	}, dispatch);
};

// TODO: Add reward point price slider to filters

let timer;

class StorePage extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {},
			'pageSize': 20,
			'orderBy': 'updatedAt',
			'searchQuery': ''
		}

		this.handleFilterReset = this.handleFilterReset.bind(this);
		this.handleOrderChange = this.handleOrderChange.bind(this);
		this.handlePageChange = this.handlePageChange.bind(this);
		this.handlePageSizeChange = this.handlePageSizeChange.bind(this);
		this.handleQueryChange = this.handleQueryChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Store";
		this.handlePageChange(1);
    }

	componentWillUnmount() {
		if (timer) {
			clearTimeout(timer);
		}
	}

	addToCart(product, index, e) {
		let quantity = 1;
		if (e) {
			e.preventDefault();
			quantity = e.target.value ? parseInt(e.target.value, 10) : 1;
		}
		this.props.addToCart(product, quantity);
	}

	getProductImage(side, product) {
		let image;
		if (side === 'front') {
			image = product.Files.filter(file => file.identifier === 'productPhotoFront');
		} else if (side === 'back') {
			image = product.Files.filter(file => file.identifier === 'productPhotoBack');
		}
		return '/uploads/' + image[0].locationUrl + image[0].name;
	}

	handleFilterReset() {
		this.setState({
			'pageSize': 20,
			'orderBy': 'updatedAt',
			'searchQuery': ''
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

	handlePageChange(pageNumber = 1) {
        this.props.searchProducts({'pageNumber': pageNumber, 'searchQuery': this.state.searchQuery, 'orderBy': this.state.orderBy, 'pageSize': this.state.pageSize}).then((pagination) => {
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
						<div className="row">
							{
								this.props.products.map((product, i) =>
								<div key={i} className="product-box">
									<div className="flipper">
										<div className="front">
											<img src={this.getProductImage.call(this, 'front', product)} alt={product.name} />
										</div>
										<div className="back">
											<img src={this.getProductImage.call(this, 'back', product)} alt={product.name}/>
										</div>
									</div>
									<div className="product-name text-center">
										<Link to={`/store/products/${product.id}`}>{product.name}</Link>
									</div>
									<div className="price text-center">
										{product.price} RP
									</div>
									<div className="small-12 columns select-qty">
										<select onChange={this.addToCart.bind(this, product, i)}>
											<option value={1}>1</option>
											<option value={2}>2</option>
											<option value={3}>3</option>
											<option value={4}>4</option>
											<option value={5}>5</option>
										</select>
									</div>
									<div className="actions text-center">
										<button className="button" onClick={this.addToCart.bind(this, product, i)}>Add To Cart</button>
										<Link className="button" to={`store/products/${product.id}`}>More Details</Link>
									</div>
								</div>
								)
							}
						</div>
					</div>
				</div>
				<div className="row">
					<div className="small-12 columns text-center">
						Pagination
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(StorePage);
