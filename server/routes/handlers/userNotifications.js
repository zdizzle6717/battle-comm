'use strict';

import models from '../../models';
import Boom from 'boom';

// Product Route Configs
let userNotifications = {
	get: (request, reply) => {
    models.UserNotification.find({
        'where': {
          'UserId': request.params.id
        }
      })
      .then((response) => {
        if (response) {
          reply(response).code(200);
        } else {
          reply().code(404);
        }

      });
  },
  create: (request, reply) => {
    models.UserNotification.findOrCreate({
        'where': {
          '$and': [{
              'UserId': request.payload.UserId
            },
            {
              'type': request.payload.type
            },
            {
              'fromId': request.payload.fromId
            }
          ]
        },
        'defaults': {
          'UserId': request.payload.UserId,
          'type': request.payload.type,
          'status': request.payload.status,
          'fromId': request.payload.fromId,
          'fromUsername': request.payload.fromUsername,
          'fromName': request.payload.fromName
        }
      })
      .then((response) => {
        let created = response[1];
        if (created) {
          reply(response).code(200);
        } else {
          reply(Boom.badRequest('Request already sent'));
        }
      });
  },
  update: (request, reply) => {
    models.UserNotification.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((userNotification) => {
        if (userNotification) {
          userNotification.updateAttributes({
            'UserId': request.payload.UserId,
            'type': request.payload.type,
            'status': request.payload.status,
          }).then((response) => {
            reply(response).code(200);
          });
        } else {
          reply().code(404);
        }
      });
  },
	'search': (request, reply) => {
    let searchByConfig;
    let pageSize = request.payload.pageSize || 20;
    let searchQuery = request.payload.searchQuery || '';
    let offset = (request.payload.pageNumber - 1) * pageSize;
		let orderBy = request.payload.orderBy ? (request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC']) : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? {
				'UserId': request.payload.UserId,
        [request.payload.searchBy]: {
          '$iLike': '%' + searchQuery + '%'
        }
      } : {
				'UserId': request.payload.UserId,
        '$or': [{
            'name': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'description': {
              '$iLike': '%' + searchQuery + '%'
            }
          }
        ]
      };
    } else {
      searchByConfig = {
				'UserId': request.payload.UserId
			};
    }
    models.UserNotification.findAndCountAll({
      'where': searchByConfig,
			'order': orderBy ? [orderBy] : [],
      'offset': offset,
      'limit': pageSize
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
  },
  delete: (request, reply) => {
    models.UserNotification.destroy({
        'where': {
          'id': request.params.id
        }
      })
      .then((response) => {
        if (response) {
          reply().code(200);
        } else {
          reply().code(404);
        }
      });
  }
};

export default userNotifications;
