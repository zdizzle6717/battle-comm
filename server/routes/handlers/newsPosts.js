'use strict';

import models from '../../models';

// Product Route Configs
let newsPosts = {
  get: (request, reply) => {
    models.NewsPost.find({
        'where': {
          'id': request.params.id
        },
        'include': [{
          'model': models.User,
          'attributes': ['firstName', 'lastName']
        }, {
					'model': models.File
				}]
      })
      .then((response) => {
        if (response) {
          reply(response).code(200);
        } else {
          reply().code(404);
        }

      });
  },
  getAll: (request, reply) => {
    models.NewsPost.findAll({
        'include': [{
          'model': models.User,
          'attributes': ['firstName', 'lastName']
        }]
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  create: (request, reply) => {
    models.NewsPost.create({
        'UserId': request.payload.UserId,
        'title': request.payload.title,
        'callout': request.payload.callout,
        'body': request.payload.body,
        'published': request.payload.published,
        'featured': request.payload.featured,
        'tags': request.payload.tags,
        'manufacturerId': request.payload.manufacturerId,
        'gameSystemId': request.payload.gameSystemId,
        'category': request.payload.category
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  update: (request, reply) => {
    models.NewsPost.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((newsPost) => {
        if (newsPost) {
          newsPost.updateAttributes({
            'UserId': request.payload.UserId,
            'title': request.payload.title,
            'callout': request.payload.callout,
            'body': request.payload.body,
            'published': request.payload.published,
            'featured': request.payload.featured,
            'tags': request.payload.tags,
            'manufacturerId': request.payload.manufacturerId,
            'gameSystemId': request.payload.gameSystemId,
            'category': request.payload.category
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
    let pageSize = parseInt(request.payload.pageSize, 10) || 20;
    let searchQuery = request.payload.searchQuery || '';
    let offset = (request.payload.pageNumber - 1) * pageSize;
		let orderBy;
		if (request.payload.orderBy === 'author') {
			orderBy = [models.User, 'lastName', 'DESC'];
		} else {
			orderBy = request.payload.orderBy ? (request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC']) : undefined;
		}
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? {
        [request.payload.searchBy]: {
          '$iLike': '%' + searchQuery + '%'
        }
      } : {
        '$or': [{
            'title': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'tags': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'body': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'category': {
              '$iLike': '%' + searchQuery + '%'
            }
          }
        ]
      };
    } else {
      searchByConfig = {};
    }
    models.NewsPost.findAndCountAll({
      'where': searchByConfig,
			'order': orderBy ? [orderBy] : [],
      'offset': offset,
      'limit': pageSize,
			'include': {
				'model': models.User
			}
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
    models.NewsPost.destroy({
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

export default newsPosts;
