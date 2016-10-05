'use strict';

popup.$inject = ['$compile'];
function popup($compile) {
	return {
		'name': 'popup',
		'transclude': true,
		'template': require('./templates/popup.html'),
		'link': link
	}

	function link(scope) {
		scope.show = false;
		scope.toggleVisibility = toggleVisibility;

		function toggleVisibility() {
			scope.show = !scope.show;
		}
	}
}

module.exports = popup;
