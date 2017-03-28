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

    render() {
        return (
            <ViewWrapper>
                <div className="row">
                    <h1>Store</h1>
                    <p>
                        <Link to="/">Go back to the main page</Link>
                    </p>
                </div>
				<div className="row">
					<div className="small-12 medium-4 large-3 columns">
						Filters
					</div>
					<div className="small-12 medium-8 large-9 columns">
						Products
						{
							this.state.products.map((product, i) =>
								<div className="product-box">
									{product.title}
								</div>
							)
						}
					</div>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(StorePage);
