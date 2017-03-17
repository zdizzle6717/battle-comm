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
        'searchKey': request.payload.searchKey,
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
            'searchKey': request.payload.searchKey,
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
