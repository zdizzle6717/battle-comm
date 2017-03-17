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
        'image': request.payload.image,
        'callout': request.payload.callout,
        'body': request.payload.body,
        'published': request.payload.published,
        'featured': request.payload.featured,
        'tags': request.payload.tags,
        'manufacturerId': request.payload.manufacturerId,
        'gameSystem': request.payload.gameSystem,
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
            'image': request.payload.image,
            'callout': request.payload.callout,
            'body': request.payload.body,
            'published': request.payload.published,
            'featured': request.payload.featured,
            'tags': request.payload.tags,
            'manufacturerId': request.payload.manufacturerId,
            'gameSystem': request.payload.gameSystem,
            'category': request.payload.category
          }).then((response) => {
            reply(response).code(200);
          });
        } else {
          reply().code(404);
        }
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
