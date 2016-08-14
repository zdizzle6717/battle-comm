'use strict';

StoreController.$inject = ['$state', '$rootScope', 'ngCart', 'StoreService', 'manufacturersSchema', '$scope'];
function StoreController($state, $rootScope, ngCart, StoreService, manufacturersSchema, $scope) {
    let controller = this;

    controller.searchQuery = '';
    controller.selectedSort = '-updated';
    controller.pageSize = '15';
    controller.priceFilter = 'showit';
    controller.currentMNU = {};
    controller.selectedMNU = {};
    controller.manufacturers = manufacturersSchema;
    controller.manufacturer = manufacturersSchema[0];

    controller.slider = {
      min: 0,
      max: 100000,
      options: {
        floor: 0,
        ceil: 100000,
        translate: function(value) {
          return value + ' RP';
        }
      }
    };

    ///////////////////////////////

    $rootScope.$on('slideEnded', function() {
        controller.update();
    });

    StoreService.getAllProducts()
        .then(function(products) {
            controller.products = products;
            controller.product = (products[0] ? products[0] : {});
        });

    controller.update = function() {
        for (let i=0, len=controller.products.length; i<len ; i++) {
             if (controller.products[i].price >= controller.slider.min && controller.products[i].price <= controller.slider.max ) {
                 controller.products[i].filterVal = 'showit';
             } else if (controller.products[i].price <= controller.slider.min || controller.products[i].price >= controller.slider.max ) {
                 controller.products[i].filterVal = 'hideit';
             }
         }
         $scope.$apply();
    };

    controller.setMNU = function(manufacturer) {
        controller.currentMNU = manufacturer;
    };

    controller.viewProduct = function(id) {
        StoreService.getProduct(id)
            .then(function() {
                $state.go('product', {
                    id: id
                });
            });
    };

    controller.reset = function() {
        controller.searchQuery = '';
        controller.selectedSort = 'updated';
        controller.pageSize = '15';
        controller.priceFilter = 'showit';
        controller.currentMNU = {};
        controller.selectedMNU = {};
        controller.slider = {
          min: 0,
          max: 10000,
          options: {
            floor: 0,
            ceil: 10000,
            translate: function(value) {
              return value + ' RP';
            }
          }
        };
        controller.update();
  };
}

module.exports = StoreController;