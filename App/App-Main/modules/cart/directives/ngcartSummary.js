'use strict';

ngcartSummary.$inject = [];
function ngcartSummary() {
    return {
        restrict : 'E',
        controller : 'CartController',
        scope: {},
        transclude: true,
        template: require('./templates/summary.php')
    };
}

module.exports = ngcartSummary;
