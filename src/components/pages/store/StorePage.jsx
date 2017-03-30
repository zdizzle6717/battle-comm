'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import CartActions from '../../../actions/CartActions';
import ProductService from '../../../services/ProductService';

const mapStateToProps = (state) => {
    return {

	}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'addToCart': CartActions.add
	}, dispatch);
};

class StorePage extends React.Component {
    constructor() {
        super();

		this.state = {
			'products': []
		}
    }

    componentDidMount() {
        document.title = "Battle-Comm | Store";
		ProductService.getAll().then((products) => {
			this.setState({
				'products': products
			})
		});
    }

	addToCart(product, index) {
		let quantity = this.state.products[index].cartQuantity;
		this.props.addToCart({
			'product': product,
			'cartQty': quantity
		});
	}

    render() {
        return (
            <ViewWrapper>
                <div className="row">
					<div className="small-12 columns">
						<h1>Store</h1>
	                    <p>
	                        <Link to="/">Go back to the main page</Link>
	                    </p>
					</div>
                </div>
				<div className="row">
					<div className="small-12 medium-4 large-3 columns product-listing">
						<div className="floating-sidebar-left">
							Floating Left Sidebar
						</div>
						<div className="small-12 medium-8 large-9 columns">
							<div className="row">
								{
									this.state.products.map((product, i) =>
									<div className="product-box">
										<div className="title">
											{product.title}
										</div>
										<div className="flipper">
											<div className="front">
												Front Image
											</div>
											<div className="back">
												Back Image
											</div>
										</div>
										<div className="select-qty">
											Quantity
										</div>
										<div className="actions">
											<button className="button" onClick={this.addToCart.bind(this, product, i)}>Add To Cart</button>
											<Link className="button" to={`store/products/${product.id}`}>More Details</Link>
										</div>
									</div>
									)
								}
							</div>
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
