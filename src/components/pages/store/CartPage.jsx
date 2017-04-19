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

    render() {
        return (
            <ViewWrapper headerImage="/images/title/Cart.png" headerAlt="Cart">
				<div className="row">
					<div className="small-12 columns">
						<h1>Shopping Cart</h1>
					</div>
					<hr />
					<div className="row">
						<div className="small-12 columns">
							<table>
								<thead>
									<tr>
										<th>SKU</th>
										<th>Name</th>
										<th>Price</th>
										<th>Qty</th>
										<th>Subtotal</th>
										<th>Remove?</th>
									</tr>
								</thead>
								<tbody>
									{
										this.props.cartItems.map((item, i) =>
											<tr key={i} className="item-row">
												<td>{item.merchItem.sku}</td>
												<td>{item.merchItem.title}</td>
												<td>${item.merchItem.price}RP</td>
												<td>({item.cartQty})</td>
												<td>{(item.cartQty * item.merchItem.price).toFixed(2)}</td>
												<td onClick={this.removeItem.bind(this, item, item.cartQty)}><span className="fa fa-minus"></span></td>
											</tr>
										)
									}
								</tbody>
							</table>
							<hr />
							<div className="small-12 columns text-right">
								Order Total: {this.props.cartTotal}
							</div>
							<Link to="store/checkout" className="button">
								Go to Checkout
							</Link>
						</div>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(CartPage)
