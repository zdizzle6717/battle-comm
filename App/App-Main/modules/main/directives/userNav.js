'use strict';

userNav.$inject = ['$compile', '$rootScope', 'AuthService'];
function userNav($compile, $rootScope, AuthService) {
	return {
		'name': 'userNav',
		'restrict': 'A',
		'replace': true,
		'link': link
	}

	function link(scope, elem, attrs) {
		let template = require('./templates/userNav.html');
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

module.exports = userNav;
