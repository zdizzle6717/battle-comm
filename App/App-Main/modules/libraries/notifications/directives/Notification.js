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
                scope.type = config.type;
                scope.show = true;
				let timeout = parseFloat(config.timeout) || 3000;
                $timeout(() => {
                    scope.show = false;
                }, timeout);
            });

            scope.$on('$destroy', listener);
        }
    };
}

module.exports = notification;
