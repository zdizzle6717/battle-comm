'use strict';

ngCartService.$inject = ['$rootScope', 'ngCartItem', 'store'];
function ngCartService($rootScope, ngCartItem, store) {
    this.init = function(){
        this.$cart = {
            shipping : null,
            taxRate : null,
            tax : null,
            items : []
        };
    };

    this.addItem = function (id, name, price, quantity, data) {

        var inCart = this.getItemById(id);

        if (typeof inCart === 'object'){
            //Update quantity of an item if it's already in the cart
            inCart.setQuantity(quantity, false);
            $rootScope.$broadcast('ngCart:itemUpdated', inCart);
        } else {
            var newItem = new ngCartItem(id, name, price, quantity, data);
            this.$cart.items.push(newItem);
            $rootScope.$broadcast('ngCart:itemAdded', newItem);
        }

        $rootScope.$broadcast('ngCart:change', {});
    };

    this.getItemById = function (itemId) {
        var items = this.getCart().items;
        var build = false;

        angular.forEach(items, function (item) {
            if  (item.getId() === itemId) {
                build = item;
            }
        });
        return build;
    };

    this.setShipping = function(shipping){
        this.$cart.shipping = shipping;
        return this.getShipping();
    };

    this.getShipping = function(){
        if (this.getCart().items.length === 0) return 0;
        return  this.getCart().shipping;
    };

    this.setTaxRate = function(taxRate){
        this.$cart.taxRate = +parseFloat(taxRate).toFixed(2);
        return this.getTaxRate();
    };

    this.getTaxRate = function(){
        return this.$cart.taxRate;
    };

    this.getTax = function(){
        return +parseFloat(((this.getSubTotal()/100) * this.getCart().taxRate )).toFixed(2);
    };

    this.setCart = function (cart) {
        this.$cart = cart;
        return this.getCart();
    };

    this.getCart = function(){
        return this.$cart;
    };

    this.getItems = function(){
        return this.getCart().items;
    };

    this.getTotalItems = function () {
        var count = 0;
        var items = this.getItems();
        angular.forEach(items, function (item) {
            count += item.getQuantity();
        });
        return count;
    };

    this.getTotalUniqueItems = function () {
        return this.getCart().items.length;
    };

    this.getSubTotal = function(){
        var total = 0;
        angular.forEach(this.getCart().items, function (item) {
            total += item.getTotal();
        });
        return +parseFloat(total).toFixed(2);
    };

    this.totalCost = function () {
        return +parseFloat(this.getSubTotal() + this.getShipping() + this.getTax()).toFixed(2);
    };

    this.removeItem = function (index) {
        var item = this.$cart.items.splice(index, 1)[0] || {};
        $rootScope.$broadcast('ngCart:itemRemoved', item);
        $rootScope.$broadcast('ngCart:change', {});

    };

    this.removeItemById = function (id) {
        var item;
        var cart = this.getCart();
        angular.forEach(cart.items, function (item, index) {
            if(item.getId() === id) {
                item = cart.items.splice(index, 1)[0] || {};
            }
        });
        this.setCart(cart);
        $rootScope.$broadcast('ngCart:itemRemoved', item);
        $rootScope.$broadcast('ngCart:change', {});
    };

    this.empty = function () {

        $rootScope.$broadcast('ngCart:change', {});
        this.$cart.items = [];
        localStorage.removeItem('cart');
    };

    this.isEmpty = function () {

        return (this.$cart.items.length > 0 ? false : true);

    };

    this.toObject = function() {

        if (this.getItems().length === 0) return false;

        var items = [];
        angular.forEach(this.getItems(), function(item){
            items.push (item.toObject());
        });

        return {
            shipping: this.getShipping(),
            tax: this.getTax(),
            taxRate: this.getTaxRate(),
            subTotal: this.getSubTotal(),
            totalCost: this.totalCost(),
            items:items
        };
    };


    this.$restore = function(storedCart){
        var _self = this;
        _self.init();
        _self.$cart.shipping = storedCart.shipping;
        _self.$cart.tax = storedCart.tax;

        angular.forEach(storedCart.items, function (item) {
            _self.$cart.items.push(new ngCartItem(item._id,  item._name, item._price, item._quantity, item._data));
        });
        this.$save();
    };

    this.$save = function () {
        return store.set('cart', JSON.stringify(this.getCart()));
    };
}

module.exports = ngCartService;
