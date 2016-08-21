'use strict';

deleteProductModal.$inject = [];
function deleteProductModal() {
    return {
        name: 'deleteProductModal',
        template: require('./templates/deleteProductModal.html'),
        transclude: true,
        scope: {
            delete: '&?'
        },
        link: function link(scope, elem, attrs) {
            scope.show = false;
            scope.deleteProduct = deleteProduct;
            scope.closeModal = closeModal;
            scope.deleteProduct = deleteProduct;

            ////////////////////

            let listener = scope.$on('show:modal', function(event, args) {
                scope.id = args.id;
                scope.show = args.toggle === true ? true : false;
            });

            scope.$on('$destroy', listener);

            function deleteProduct(id) {
                scope.delete({
                    id: id
                });
                scope.show = false;
            }

            function closeModal() {
                scope.show = false;
            }

        }
    };
}

module.exports = deleteProductModal;
