'use strict';

ProductController.$inject = ['$rootScope', '$state', '$stateParams', 'AdminService', 'manufacturers'];
function ProductController($rootScope, $state, $stateParams, AdminService, manufacturers) {
    let controller = this;

    controller.readOnly = true;
    controller.editProduct = editProduct;
    controller.saveProduct = saveProduct;
    controller.removeProduct = removeProduct;
    controller.setMNU = setMNU;
    controller.currentMNU = {};
    controller.selectedMNU = {};
    controller.manufacturers = manufacturers;
    controller.manufacturer = manufacturers[0];
    controller.showDeleteModal = showDeleteModal;
    controller.hideDeleteModal = hideDeleteModal;

    init();

    ///////////////////////////////////////////

    function init() {
        if ($stateParams.id) {AdminService.getProduct($stateParams.id)
            .then(function(response) {
                controller.currentProduct = response;
                controller.currentProduct.displayStatus = response.displayStatus === true ? 'true' : 'false';
                controller.currentProduct.new = response.new === true ? 'true' : 'false';
                controller.currentProduct.featured = response.featured === true ? 'true' : 'false';
                controller.currentProduct.onSale = response.onSale === true ? 'true' : 'false';
                controller.readOnly = true;
                controller.isNew = false;
            });
        } else {
            controller.currentProduct = {
                displayStatus: 'true',
                new: 'true',
                featured: 'false',
                onSale: 'false'
            };
            controller.readOnly = false;
            controller.isNew = true;
        }
    }

    function setMNU(manufacturer) {
        controller.currentMNU = manufacturer;
    }

    // $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams, options) {
    //     if ($state)
    // });

    function editProduct() {
        controller.readOnly = false;
    }

    function saveProduct(data, images) {
        data.filterVal = 'showit';
        data.inStock = data.stockQty > 0 ? true : false;
        data.manufacturerId = data.manufacturer ? data.manufacturer.id : data.manufacturerId;
        delete data.manufacturer;
        if ($stateParams.id) {
            controller.readOnly = true;
            AdminService.updateProduct($stateParams.id, data)
            .then(function(response) {
                controller.currentProduct = response;
                controller.currentProduct.displayStatus = response.displayStatus === true ? 'true' : 'false';
                controller.currentProduct.new = response.new === true ? 'true' : 'false';
                controller.currentProduct.featured = response.featured === true ? 'true' : 'false';
                controller.currentProduct.onSale = response.onSale === true ? 'true' : 'false';
                showAlert({
                    type: 'success',
                    message: 'This product was successfully updated.'
                });
            });
        }
        else {
            AdminService.createProduct(data)
            .then(function(response) {
                showAlert({
                    type: 'success',
                    message: 'A new product was successfully created.'
                });
                $state.go('product', {id: response.id});
            });
        }
    }

    function removeProduct(id) {
        AdminService.removeProduct(id)
        .then(function() {
            showAlert({
                type: 'success',
                message: 'Product was successfully deleted.'
            });
            $state.go('productList');
        });
    }

    function showDeleteModal(id) {
        $rootScope.$broadcast('show:modal', {
            id: id,
            toggle: true
        });
    }

    function hideDeleteModal() {
        $rootScope.$broadcast('show:modal', { toggle: false });
    }

    function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }
}

module.exports = ProductController;
