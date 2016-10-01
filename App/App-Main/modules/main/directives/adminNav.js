'use strict';

adminNav.$inject = ['$compile', '$rootScope', 'AuthService'];
function adminNav($compile, $rootScope, AuthService) {
	return {
		'name': 'adminNav',
		'restrict': 'A',
		'replace': true,
		'link': link
	}

	function link(scope, elem, attrs) {
		let template = require('./templates/adminNav.html');
		scope.user = AuthService.currentUser;

		checkAuthentication();

		$rootScope.$on('$stateChangeStart', checkAuthentication);

		////////////////////////

		function checkAuthentication() {
			if (AuthService.isAuthenticated) {
				elem.html(template);
			} else {
				elem.html('');
			}

			$compile(elem.contents())(scope);
		}

	}
}

module.exports = adminNav;
