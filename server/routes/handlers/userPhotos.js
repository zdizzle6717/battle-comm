'use strict';

import models from '../../models';
import Boom from 'boom';

// Product Route Configs
let userPhotos = {
  create: (request, reply) => {
    models.UserPhoto.create({
        'UserId': request.payload.UserId,
        'url': request.payload.url
      })
      .then((response) => {
        reply(response).code(200);
      })
      .catch((response) => {
        reply(Boom.badRequest(response));
      });
  }
};


export default userPhotos;
