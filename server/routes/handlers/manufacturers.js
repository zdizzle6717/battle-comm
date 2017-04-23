'use strict';

import models from '../../models';

// Product Route Configs
let manufacturers = {
  get: (request, reply) => {
    models.Manufacturer.find({
        'where': {
          'id': request.params.id
        },
        'include': [{
          'model': models.GameSystem
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
    models.Manufacturer.findAll({
        'include': [{
          'model': models.GameSystem
        }]
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  create: (request, reply) => {
    models.Manufacturer.create({
        'name': request.payload.name,
        'description': request.payload.description,
        'photo': request.payload.photo,
        'url': request.payload.url
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  update: (request, reply) => {
    models.Manufacturer.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((newsPost) => {
        if (newsPost) {
          newsPost.updateAttributes({
            'name': request.payload.name,
            'description': request.payload.description,
            'photo': request.payload.photo,
            'url': request.payload.url
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
		let orderBy = request.payload.orderBy ? (request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC']) : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? {
        [request.payload.searchBy]: {
          '$iLike': '%' + searchQuery + '%'
        }
      } : {
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
      searchByConfig = {};
    }
    models.Manufacturer.findAndCountAll({
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
    models.Manufacturer.destroy({
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

export default manufacturers;
