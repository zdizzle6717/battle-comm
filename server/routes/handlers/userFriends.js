'use strict';

import models from '../../models';

// Product Route Configs
let userFriends = {
  create: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.payload.UserId
        }
      })
      .then((user1) => {
        models.User.find({
            'where': {
              'id': request.payload.InviteeId
            }
          })
          .then((user2) => {
            user1.addFriend(user2).then((user1Response) => {
              user2.addFriend(user1).then((user2Response) => {
                reply(user1Response).code(200);
              });
            });
          })
          .catch((response) => {
            reply(response).code(404);
          });
      })
      .catch((response) => {
        reply(response).code(404);
      });
  },
  remove: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.params.UserId
        }
      })
      .then((user1) => {
        models.User.find({
            'where': {
              'id': request.params.InviteeId
            }
          })
          .then((user2) => {
            user1.removeFriend(user2).then((user1Response) => {
              user2.removeFriend(user1).then((user2Response) => {
                reply(user1Response).code(200);
              });
            });
          })
          .catch((response) => {
            reply(response).code(404);
          });
      })
      .catch((response) => {
        reply(response).code(404);
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
				'model': models.User,
				'as': 'Friends',
				'attributes': ['id', 'firstName', 'lastName', 'username']
			},]
		}).then((user) => {
			user = user.get({
				'plain': true
			});
			let results = user.Friends;
			let totalPages = Math.ceil(results.length === 0 ? 1 : (results.length / pageSize));
			reply({
				'pagination': {
					'pageNumber': request.payload.pageNumber,
					'pageSize': pageSize,
					'totalPages': totalPages,
					'totalResults': results.length
				},
				'results': user.Friends.splice(offset, offset + pageSize)
			}).code(200);
		});
  }
};


export default userFriends;
