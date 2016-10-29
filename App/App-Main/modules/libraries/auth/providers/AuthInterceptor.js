'use strict';

function AuthInterceptor() {

	this.interceptor = ['$q', '$injector', function($q, $injector) {
		return {
			'response': (response) => {
				return $q.resolve(response);
			},
			'responseError': (response) => {
				let restricted = response.status === 401;

				if (restricted) {
					$injector.get('AuthService').logout();
					$injector.get('$state').go('login', {}, {reload: true});
				}

				return $q.reject(response);
			}
		}
	}];

	this.$get = () => {};
}

module.exports = AuthInterceptor;
