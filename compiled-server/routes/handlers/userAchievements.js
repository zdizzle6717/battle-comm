'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

var _boom = require('boom');

var _boom2 = _interopRequireDefault(_boom);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Product Route Configs
var userAchievements = {
	create: function create(request, reply) {
		_models2.default.User.find({
			'where': {
				'id': request.payload.UserId
			}
		}).then(function (user) {
			_models2.default.Achievement.find({
				'where': {
					'$or': [{
						'id': request.payload.AchievementId
					}, {
						'title': request.payload.AchievementTitle
					}]
				}
			}).then(function (achievement) {
				if (achievement) {
					user.addAchievement(achievement).then(function (user) {
						reply(user).code(200);
					});
				} else {
					reply(_boom2.default.notFound('No achievement found with the supplied id or title'));
				}
			});
		});
	},
	remove: function remove(request, reply) {
		_models2.default.User.find({
			'where': {
				'id': request.params.UserId
			}
		}).then(function (user) {
			_models2.default.Achievement.find({
				'where': {
					'$or': [{
						'id': request.payload.AchievementId
					}, {
						'title': request.payload.AchievementTitle
					}]
				}
			}).then(function (achievement) {
				if (achievement) {
					user.removeAchievement(achievement).then(function (user) {
						reply(user).code(200);
					});
				} else {
					reply(_boom2.default.notFound('No achievement found with the supplied id or title'));
				}
			});
		});
	},
	'search': function search(request, reply) {
		var pageSize = parseInt(request.payload.pageSize, 10) || 20;
		var offset = (request.payload.pageNumber - 1) * pageSize;

		_models2.default.User.find({
			'where': {
				'username': request.payload.username
			},
			'include': [{
				'model': _models2.default.Achievement
			}]
		}).then(function (user) {
			user = user.get({
				'plain': true
			});
			var results = user.Achievements;
			var totalPages = Math.ceil(results.length === 0 ? 1 : results.length / pageSize);
			reply({
				'pagination': {
					'pageNumber': request.payload.pageNumber,
					'pageSize': pageSize,
					'totalPages': totalPages,
					'totalResults': results.length
				},
				'results': user.Achievements.splice(offset, offset + pageSize)
			}).code(200);
		});
	}
};

exports.default = userAchievements;