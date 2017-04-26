'use strict';

import React from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import ViewWrapper from '../../ViewWrapper';
import CartActions from '../../../actions/CartActions';

const mapStateToProps = (state) => {
	return {
		'cartTotal': state.cartTotal,
		'cartItems': state.cartItems
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'updateOrderTotal': CartActions.updateTotal,
		'addItem': CartActions.add,
		'removeItem': CartActions.remove
	}, dispatch);
}

class CartPage extends React.Component {
    constructor() {
        super();
    }

    componentDidMount() {
        document.title = "Battle-Comm | Shopping Cart";
    }

	removeItem(product, quantity) {
		this.props.removeItem(product, quantity);
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Cart.png" headerAlt="Cart">
				<div className="row">
					<hr />
					<div className="small-12 columns">
						<table className="text-center">
							<thead>
								<tr>
									<th className="text-center">SKU</th>
									<th className="text-center">Name</th>
									<th className="text-center">Price</th>
									<th className="text-center">Qty</th>
									<th className="text-center">Subtotal</th>
									<th className="text-center">Remove?</th>
								</tr>
							</thead>
							<tbody>
								{
									this.props.cartItems.map((item, i) =>
										<tr key={i} className="item-row">
											<td>{item.product.SKU}</td>
											<td>{`${item.product.name.substring(0, 25)}...`}</td>
											<td>${item.product.price}RP</td>
											<td>({item.cartQty})</td>
											<td>{(item.cartQty * item.product.price).toFixed(2)}</td>
											<td onClick={this.removeItem.bind(this, item, item.cartQty)}><span className="fa fa-minus pointer"></span></td>
										</tr>
									)
								}
							</tbody>
						</table>
					</div>
					<hr />
					<div className="small-12 columns text-right">
						Order Total: {this.props.cartTotal}
					</div>
					<div className="small-12 columns">
						<Link to="store/checkout" className="button">
							Go to Checkout
						</Link>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(CartPage)
