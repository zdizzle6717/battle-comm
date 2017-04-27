'use strict';

import React from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import ViewWrapper from '../../ViewWrapper';
import CartActions from '../../../actions/CartActions';

const mapStateToProps = (state) => {
	return {
		'cartItems': state.cartItems
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'addItem': CartActions.add,
		'update': CartActions.update,
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

	getOrderTotal(items) {
		let total = 0;
		items.forEach((item) => {
			total += parseInt(item.product.price, 10) * parseInt(item.cartQty, 10);
		});
		return total;
	}

	removeItem(product) {
		this.props.removeItem(product);
	}

	updateItemQty(item, increment) {
		let newQty = item.cartQty;
		if (increment === 'add') {
			newQty++;
		} else if (increment === 'subtract') {
			newQty--;
		}
		this.props.update(item.product, newQty);
	}

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Cart.png" headerAlt="Cart">
				<div className="row">
					<hr />
					<div className="small-12 columns">
						<table className="stack hover text-center">
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
											<td>{item.product.price} RP</td>
											<td><span className="fa fa-minus pointer" onClick={this.updateItemQty.bind(this, item, 'subtract')}></span> ({item.cartQty}) <span className="fa fa-plus pointer" onClick={this.updateItemQty.bind(this, item, 'add')}></span></td>
											<td>{(item.cartQty * item.product.price).toFixed(2)}</td>
											<td onClick={this.removeItem.bind(this, item)}><span className="fa fa-times-circle-o pointer"></span></td>
										</tr>
									)
								}
							</tbody>
						</table>
					</div>
					<hr />
					<div className="small-12 columns text-right">
						<h4>Order Total: <strong>{this.getOrderTotal.call(this, this.props.cartItems)} RP</strong></h4>
					</div>
					<div className="small-12 columns text-center">
						<Link to="/store/checkout" className="button">
							Go to Checkout
						</Link>
					</div>
                </div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(CartPage)
