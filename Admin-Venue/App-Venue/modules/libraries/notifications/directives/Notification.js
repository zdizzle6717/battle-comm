'use strict';

notification.$inject = ['$timeout'];
function notification($timeout) {
    return {
        name: 'notification',
        template: require('./templates/notification.html'),
        scope: true,
        link: function link(scope, elem, attrs, ctrl) {
            scope.show = false;
            let listener = scope.$on('show:notification', function(event, config) {
                scope.message = config.message;
				let _timeout = config.timeout || 2000;
                if (config.type === 'error') {
                    scope.type = 'error';
                } else if (config.type === 'success') {
                    scope.type = 'success';
                }
                scope.show = true;
                $timeout(() => {
                    scope.show = false;
                }, _timeout);
            });

            scope.$on('$destroy', listener);
        }
    };
}

module.exports = notification;
