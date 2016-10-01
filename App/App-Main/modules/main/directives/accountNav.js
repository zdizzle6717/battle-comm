'use strict';

accountNav.$inject = ['$compile', '$state', '$rootScope', 'AuthService'];
function accountNav($compile, $state, $rootScope, AuthService) {
	return {
		'name': 'accountNav',
		'restrict': 'A',
		'link': link
	}

	function link(scope, elem, attrs) {
		let template = require('./templates/accountNav.html');
		scope.user = AuthService.currentUser;
		scope.toggleNav = toggleNav;
		scope.logout = logout;

		checkAuthentication();

		$rootScope.$on('$stateChangeStart', checkAuthentication);

		/////////////////////////////////

		function checkAuthentication() {
			scope.showNav = false;
			if (AuthService.isAuthenticated) {
				elem.html(template);
			} else {
				elem.html('');
			}

			$compile(elem.contents())(scope);
		}

		function toggleNav() {
			scope.showNav = !scope.showNav;
		}

		function logout() {
			AuthService.logout();
			$state.go('login');
		}
	}
}

module.exports = accountNav;
