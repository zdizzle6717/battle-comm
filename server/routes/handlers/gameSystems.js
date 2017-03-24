'use strict';

import models from '../../models';

// Product Route Configs
let gameSystems = {
  get: (request, reply) => {
    models.GameSystem.find({
        'where': {
          'id': request.params.id
        },
        'include': [{
            'model': models.Manufacturer
          },
          {
            'model': models.Faction
          }
        ]
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
    models.GameSystem.findAll({
        'include': [{
            'model': models.Manufacturer
          },
          {
            'model': models.Faction
          }
        ]
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  create: (request, reply) => {
    models.GameSystem.create({
        'ManufacturerId': request.payload.ManufacturerId,
        'name': request.payload.name,
        'description': request.payload.description,
        'searchKey': request.payload.searchKey,
        'url': request.payload.url
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  update: (request, reply) => {
    models.GameSystem.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((newsPost) => {
        if (newsPost) {
          newsPost.updateAttributes({
            'ManufacturerId': request.payload.ManufacturerId,
            'name': request.payload.name,
            'description': request.payload.description,
            'searchKey': request.payload.searchKey,
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
    let pageSize = request.payload.pageSize || 20;
    let searchQuery = request.payload.searchQuery || '';
    let offset = (request.payload.pageNumber - 1) * pageSize;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? {
        [request.payload.searchBy]: {
          '$like': '%' + searchQuery + '%'
        }
      } : {
        '$or': [{
            'name': {
              '$like': '%' + searchQuery + '%'
            }
          },
          {
            'description': {
              '$like': '%' + searchQuery + '%'
            }
          }
        ]
      };
    } else {
      searchByConfig = {};
    }
    models.GameSystem.findAndCountAll({
      'where': searchByConfig,
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
    models.GameSystem.destroy({
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


export default gameSystems;
