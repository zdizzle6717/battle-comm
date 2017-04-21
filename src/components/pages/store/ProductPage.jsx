'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import ProductService from '../../../services/ProductService';

export default class ProductPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'product': {}
		}
    }

    componentDidMount() {
        document.title = "Battle-Comm | Product";
		if (!this.props.params.productId) {
			browserHistory.push('/products');
		} else {
			ProductService.get(this.props.params.productId).then((product) => {
				this.setState({
					'product': product
				});
			});
		}
    }

    render() {
		let product = this.state.product;
        return (
            <ViewWrapper headerImage="/images/title/Product_Details.png" headerAlt="Product Details">
                <div className="row">
					<div className="small-12 columns">
						<h1>Product {product.name}</h1>
					</div>
					<hr />
                </div>
				<div className="row">
					<div className="small-12 medium-8 large-9 columns">
						<p>{product.description}</p>
					</div>
					<div className="small-12 medium-4 large-3 columns">
						<div className="panel push-bottom-2x push-top">
							<div className="panel-title color-black">
								Item Actions
							</div>
							<div className="panel-content text-center">
								<label>Quantity</label>
								<select value={this.state.itemQty}>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<button className="button black small-12" onClick={this.addToCart}>Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
