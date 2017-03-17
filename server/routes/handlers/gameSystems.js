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
        'photo': request.payload.photo,
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
