'use strict';

function LoadingServiceProvider() {
    let timer;
    let numLoadings = 0;
    let _timeout = 300;

    Object.defineProperties(this, {
        'timeout': {
            set: timeout => {
                _timeout = timeout;
            }
        }
    });

    this.interceptor = ['$q', '$rootScope', '$timeout', function($q, $rootScope, $timeout) {
        return {
            request: function(config) {
                numLoadings++;

                if (numLoadings < 2) {
                    timer = $timeout(function() {
                        $rootScope.$broadcast('showLoading');
                    }, _timeout);
                }

                return config;
            },

            response: function(response) {
                if (numLoadings === 0) {
                    return response;
                }

                if (numLoadings < 2) {
                    $timeout.cancel(timer);
                    $rootScope.$broadcast('hideLoading');
                }

                numLoadings--;

                return response;
            },

            responseError: function(response) {
                if (numLoadings === 0) {
                    return response;
                }

                if (numLoadings < 2) {
                    $timeout.cancel(timer);
                    $rootScope.$broadcast('hideLoading');
                }

                numLoadings--;

                return $q.reject(response);
            }
        };
    }];

    this.$get = () => {

    };
}

module.exports = LoadingServiceProvider;
