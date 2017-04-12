'use strict';

import models from '../../models';
import Boom from 'boom';
import fse from 'fs-extra';
import env from '../../../envVariables.js';

// Product Route Configs
let userPhotos = {
	create: (request, reply) => {
    models.UserPhoto.create({
        'UserId': request.payload.UserId,
        'locationUrl': request.payload.locationUrl,
        'identifier': request.payload.identifier,
        'label': request.payload.label,
        'name': request.payload.name,
        'size': request.payload.size,
        'type': request.payload.type
      })
      .then((userPhoto) => {
        reply(userPhoto).code(200);
      });
  },
	update: (request, reply) => {
    models.UserPhoto.find({
      'where': {
        'id': request.params.id
      }
    }).then((userPhoto) => {
      if (userPhoto) {
        userPhoto.updateAttributes({
            'UserId': request.payload.UserId,
            'identifier': request.payload.identifier,
            'locationUrl': request.payload.locationUrl,
            'label': request.payload.label,
            'name': request.payload.name,
            'size': request.payload.size,
            'type': request.payload.type
          })
          .then((userPhoto) => {
            reply(userPhoto).code(200);
          });
      } else {
        reply().code(404);
      }
    });
  },
	delete: (request, reply) => {
		// TODO: Delete resized versions of user photo
    models.UserPhoto.find({
      'where': {
        'id': request.params.id
      }
    }).then((userPhoto) => {
      if (!userPhoto.locationUrl || userPhoto.locationUrl.slice(-1) === '/' || userPhoto.locationUrl.indexOf('.') < 0) {
        reply(Boom.notAcceptable('UserPhoto object is missing a proper locationUrl property'));
      } else {
				let locationUrl = __dirname + '/../../..' + env.uploadPath + userPhoto.locationUrl;
        models.UserPhoto.destroy({
            'where': {
              'id': request.params.id
            }
          })
          .then((userPhoto) => {
            if (userPhoto) {
							fse.unlink(locationUrl, (err) => {
								if (err) {
									reply(Boom.badRequest('Error deleting user photo file.'));
									return;
								}
								reply().code(200);
							});
            } else {
              reply().code(404);
            }
          });
      }
    });
  }
};


export default userPhotos;
