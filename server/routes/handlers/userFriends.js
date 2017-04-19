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
    let searchByConfig;
    let pageSize = parseInt(request.payload.pageSize, 10) || 20;
    let searchQuery = request.payload.searchQuery || '';
    let offset = (request.payload.pageNumber - 1) * pageSize;
		let orderBy = request.payload.orderBy ? (request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC']) : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? {
				'UserId': request.params.UserId,
        [request.payload.searchBy]: {
          '$iLike': '%' + searchQuery + '%'
        }
      } : {
				'UserId': request.params.UserId,
        '$or': [{
            'username': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'email': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
					{
            'firstName': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'lastName': {
              '$iLike': '%' + searchQuery + '%'
            }
          }
        ]
      };
    } else {
      searchByConfig = {};
    }
		// TODO: Make sure this search actually works and searches the join table "userHasFriends"
    models.Friend.findAndCountAll({
      'where': searchByConfig,
			'order': orderBy ? [orderBy] : [],
      'offset': offset,
			'limit': request.payload.pageSize,
			'include': [{
				'model': models.UserPhoto
			}]
    }).then((response) => {
      let count = response.count;
      let results = response.rows;
      let totalPages = Math.ceil(count === 0 ? 1 : (count / pageSize));

      reply({
        'pagination': {
          'pageNumber': request.payload.pageNumber,
          'pageSize': pageSize,
          'totalPages': totalPages,
          'totalResults': count
        },
        'results': results
      }).code(200);
    });
  }
};


export default userFriends;
