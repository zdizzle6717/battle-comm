'use strict';

AuthService.$inject = ['$q', '$http', 'API_ROUTES'];
function AuthService($q, $http, API_ROUTES) {
	let _user = JSON.parse(localStorage.getItem('currentUser')) || JSON.parse(sessionStorage.getItem('currentUser')) || { username: '', password: '' };
	let _isAuthenticated = JSON.parse(localStorage.getItem('isAuthenticated')) || JSON.parse(sessionStorage.getItem('isAuthenticated')) || false;

	Object.defineProperties(this, {
		'currentUser': {
			'get': () => {
				return _user;
			}
		},
		'isAuthenticated': {
			'get': () => {
				return _isAuthenticated;
			}
		},
		'token': {
			'get': () => {
				return _user.id_token;
			}
		},
	});

	this.register = function(credentials) {
		// Post Login Credentials
		let args = {
			method: 'POST',
			url: API_ROUTES.users.register,
			data: {
				email: credentials.email,
				username: credentials.username,
				password: credentials.password
			}
		};

		return $http(args)
			.then(function(response) {
				$http.defaults.headers.common.Authorization = 'Bearer ' + response.data.id_token;
				_isAuthenticated = true;
				_user = response.data;
				_user.username = credentials.username;
				_user.password = credentials.password;
				if (credentials.rememberLogin || credentials.loginAuto) {
					localStorage.setItem('currentUser', JSON.stringify(_user));
					localStorage.setItem('isAuthenticated', JSON.stringify(_isAuthenticated));
				} else {
					sessionStorage.setItem('currentUser', JSON.stringify(_user));
					sessionStorage.setItem('isAuthenticated', JSON.stringify(_isAuthenticated));
				}
				return response;
			});
	};

	this.authenticate = function(credentials) {
		// Post Login Credentials
		let args = {
			method: 'POST',
			url: API_ROUTES.users.authenticate,
			data: {
				username: credentials.username,
				password: credentials.password
			}
		};

		return $http(args)
			.then(function(response) {
				$http.defaults.headers.common.Authorization = 'Bearer ' + response.data.id_token;
				_isAuthenticated = true;
				_user = response.data;
				_user.username = credentials.username;
				_user.password = credentials.password;
				_user.rememberLogin = credentials.rememberLogin;
				_user.loginAuto = credentials.loginAuto;

				if (credentials.rememberLogin) {
					localStorage.setItem('currentUser', JSON.stringify(_user));
				}
				if (credentials.loginAuto) {
					localStorage.setItem('currentUser', JSON.stringify(_user));
					localStorage.setItem('isAuthenticated', JSON.stringify(_isAuthenticated));
				}

				sessionStorage.setItem('currentUser', JSON.stringify(_user));
				sessionStorage.setItem('isAuthenticated', JSON.stringify(_isAuthenticated));

				return response;
			});
	};

	this.isAuthorized = function(accessLevel) {
		if (accessLevel[0] === 'public') {
			return true;
		} else if (_isAuthenticated) {
			let check = false;
			for (var i in accessLevel) {
				if (_user[accessLevel[i]] === true) {
					check = true;
				}
			}
			return check;
		} else {
			return false;
		}
	};

	this.logout = function() {
		_user = { username: '', password: '' };
		_isAuthenticated = false;
		sessionStorage.removeItem('currentUser');
		sessionStorage.removeItem('isAuthenticated');
		localStorage.removeItem('currentUser');
		localStorage.removeItem('isAuthenticated');
	}

}

module.exports = AuthService;
