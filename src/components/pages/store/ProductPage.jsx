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
						User Actions
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
