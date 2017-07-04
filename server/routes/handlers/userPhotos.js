'use strict';

import models from '../../models';
import Boom from 'boom';
import fse from 'fs-extra';
import env from '../../../envVariables';
import imageConfig from '../../constants/imageConfig';

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
        // TODO: Double check that this is safe and will not delete directories
        models.UserPhoto.find({
            'where': {
                'id': request.params.id
            }
        }).then((userPhoto) => {
            if (!userPhoto.locationUrl || !userPhoto.name) {
                reply(Boom.notAcceptable('UserPhoto object is missing a proper locationUrl property or file name'));
            }
            let fileName = userPhoto.name;
            let locationPath = __dirname + '/../../../dist' + userPhoto.locationUrl;
            let locationUrl = locationPath + fileName;
            if (locationUrl.slice(-1) === '/' || locationUrl.indexOf('.') < 0) {
                reply(Boom.notAcceptable('UserPhoto object is missing a proper locationUrl property or file name'));
            } else {
                // Delete files
                models.UserPhoto.destroy({
                        'where': {
                            'id': request.params.id
                        }
                    })
                    .then((file) => {
                        if (file) {
                            fse.unlink(locationUrl, (err) => {
                                if (err) {
                                    reply(Boom.badRequest('Error deleting user photo file.'));
                                } else {
                                    let count = 0;
                                    imageConfig[userPhoto.identifier].sizes.forEach((size) => {
                                        fse.unlink(`${locationPath}/${size}-${fileName}`, (error) => {
                                            if (error) {
                                                console.log(error);
                                                reply(Boom.badRequest('Error deleting user photo file.'));
                                            } else {
                                                count++;
                                                if (count >= imageConfig[userPhoto.identifier].sizes.length) {
                                                    reply().code(200);
                                                }
                                            }
                                        });
                                    });
                                }
                            });
                        } else {
                            reply(Boom.notFound('File missing, cannot delete.'));
                        }
                    });
            }
        });
    }
};


export default userPhotos;
