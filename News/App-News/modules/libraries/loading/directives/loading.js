'use strict';

loading.$inject = ['$rootScope'];
function loading($rootScope) {
    return {
        name: 'loading',
        scope: {},
        restrict: 'A',
        replace: true,
        template: require('./templates/loading.html'),
        link: function(scope) {
            scope.loading = false;

            function showLoading() {
                scope.loading = true;
            }

            function hideLoading() {
                scope.loading = false;
            }

            $rootScope.$on('showLoading', showLoading);
            $rootScope.$on('hideLoading', hideLoading);
        }
    };
}

module.exports = loading;
