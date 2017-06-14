'use strict';

import models from '../../models';
import Boom from 'boom';

// Product Route Configs
let userAchievements = {
  create: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.payload.UserId
        }
      })
      .then((user) => {
				models.Achievement.find({
					'where': {
						'$or': [
							{
								'id': request.payload.AchievementId
							},
							{
								'title': request.payload.AchievementTitle
							},
						]
					}
				})
				.then((achievement) => {
					if (achievement) {
						user.addUserAchievement(achievement).then((userHasAchievements) => {
							if (request.payload.notify) {
								models.UserNotification.create({
									'UserId': request.payload.UserId,
				          'type': 'newAchievement',
				          'fromUsername': 'systemAdmin',
									'details': request.payload.AchievementTitle
								}).then(() => {
									reply(userHasAchievements).code(200);
								});
							} else {
								reply(userHasAchievements).code(200);
							}
						});
					} else {
						reply(Boom.notFound('No achievement found with the supplied id or title'));
					}
				});
      });
  },
  createAndNotify: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.payload.UserId
        }
      })
      .then((user) => {
				models.Achievement.find({
					'where': {
						'$or': [
							{
								'id': request.payload.AchievementId
							},
							{
								'title': request.payload.AchievementTitle
							},
						]
					}
				})
				.then((achievement) => {
					if (achievement) {
						user.addUserAchievement(achievement).then((userHasAchievements) => {
							reply(userHasAchievements).code(200);
						});
					} else {
						reply(Boom.notFound('No achievement found with the supplied id or title'));
					}
				});
      });
  },
  remove: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.params.UserId
        }
      })
      .then((user) => {
				models.Achievement.find({
					'where': {
						'id': request.params.AchievementId
					},
				})
				.then((achievement) => {
					if (achievement) {
						user.removeUserAchievement(achievement).then((user) => {
							reply(user).code(200);
						});
					} else {
						reply(Boom.notFound('No achievement found with the supplied id or title'));
					}
				});
      });
  },
	'search': (request, reply) => {
    let pageSize = parseInt(request.payload.pageSize, 10) || 20;
    let offset = (request.payload.pageNumber - 1) * pageSize;

		models.User.find({
			'where': {
				'username': request.payload.username
			},
			'include': [{
				'model': models.Achievement
			}]
		}).then((user) => {
			user = user.get({
				'plain': true
			});
			let results = user.Achievements;
			let totalPages = Math.ceil(results.length === 0 ? 1 : (results.length / pageSize));
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


export default userAchievements;
