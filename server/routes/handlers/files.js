'use strict';

import models from '../../models';
import fse from 'fs-extra';
import env from '../../../envVariables.js';
import imageConfig from '../../constants/imageConfig';
import Boom from 'boom';
import im from 'imagemagick-stream';

// TODO: Switch to npm package 'gm' for image modification
// TODO: Figure out why imagemagick-stream is not properly resizing images

// File Upload Route Configs
let files = {
  create: (request, reply) => {
    models.File.create({
        'BannerSlideId': request.payload.BannerSlideId,
        'GameSystemId': request.payload.GameSystemId,
        'ManufacturerId': request.payload.ManufacturerId,
        'NewsPostId': request.payload.NewsPostId,
        'ProductId': request.payload.ProductId,
        'UserId': request.payload.UserId,
        'UserAchievementId': request.payload.UserAchievementId,
        'identifier': request.payload.identifier,
        'locationUrl': request.payload.locationUrl,
        'label': request.payload.label,
        'name': request.payload.name,
        'size': request.payload.size,
        'type': request.payload.type
      })
      .then((file) => {
        reply(file).code(200);
      });
  },
  update: (request, reply) => {
    models.File.find({
      'where': {
        'id': request.params.id
      }
    }).then((file) => {
      if (file) {
        file.updateAttributes({
            'BannerSlideId': request.payload.BannerSlideId,
            'GameSystemId': request.payload.GameSystemId,
            'ManufacturerId': request.payload.ManufacturerId,
            'NewsPostId': request.payload.NewsPostId,
            'ProductId': request.payload.ProductId,
            'UserId': request.payload.UserId,
            'UserAchievementId': request.payload.UserAchievementId,
            'identifier': request.payload.identifier,
            'locationUrl': request.payload.locationUrl,
            'label': request.payload.label,
            'name': request.payload.name,
            'size': request.payload.size,
            'type': request.payload.type
          })
          .then((file) => {
            reply(file).code(200);
          });
      } else {
        reply().code(404);
      }
    });
  },
  add: (request, reply) => {
    let data = request.payload;
    if (!data.path || !data.fileSize) {
      reply(Boom.badRequest(`A 'path' and 'fileSize' attribute must be appended to the FormData object`));
    } else if (data.file) {

			// Handle any image resizing and duplication here
      let resizeArray = [];
      if (data.identifier === 'playerIcon') {
				imageConfig[data.identifier].sizes.forEach((size) => {
					resizeArray.push({
						'name': `${size}-${data.file.hapi.filename}`,
						'resize': im().resize(`${size}x${size}!`).quality(100)
					});
				});
      }

      let filename = data.file.hapi.filename;
      let location = __dirname + '/../../..' + env.uploadPath + data.path;
      let path = location + filename;

      // Using ensureDir instead of ensureFile allow us to overwrite files if they already exist
      fse.ensureDir(location, (err) => {
        if (err) {
          reply(Boom.notAcceptable('An error occured during ensureDir'));
          return;
        }

        // Create the initial file to read from
        let file = fse.createWriteStream(path);
        data.file.pipe(file);
        data.file.on('end', (err) => {
          if (err) {
            reply(Boom.notAcceptable('An error occured on file end (resizeArray loop)'));
            return;
          }

          // TODO: Double check that type is correct
          let successResponse = {
            'file': {
              'name': filename,
              'size': data.fileSize,
              'type': data.file.hapi.headers['content-type'],
							'locationUrl': env.uploadPath + data.path
            },
            'filename': data.file.hapi.filename,
            'headers': data.file.hapi.headers,
            'status': 200,
            'statusText': 'File uploaded successfully!'
          };

          if (resizeArray.length > 0) {
						let count = 0;
            resizeArray.forEach((resizeConfig) => {
              let read = fse.createReadStream(path);
              let resizePath = location + resizeConfig.name;
              let write = fse.createWriteStream(resizePath);
              read.pipe(resizeConfig.resize).pipe(write);

              read.on('end', (err) => {
                if (err) {
                  reply(Boom.notAcceptable('An error occured on file end (resizeArray loop)'));
                  return;
                }
                // Set file folder permissions and owners/groups just for safe measure
                fse.chownSync(location, env.serverUID, env.serverGID);
                fse.chmodSync(location, '0775');

								// Wait for all files to upload before returning response
								// TODO: Double check that this works
                count++;
								if (count >= resizeArray.length) {
									reply(JSON.stringify(successResponse)).code(200);
								}
              });
            });
          } else {
            // Set file folder permissions and owners/groups just for safe measure
            fse.chown(location, env.serverUID, env.serverGID, (err) => {
              if (err) {
                reply(Boom.notAcceptable('chown: ' + err));
                return;
              }
              fse.chmod(location, '0775', (err) => {
                if (err) {
                  reply(Boom.notAcceptable('chown: ' + err));
                  return;
                }

                reply(JSON.stringify(successResponse));
              });
            });
          }
        });
      });
    } else {
      reply(Boom.badRequest('There was an error uploading your file.'));
    }
  },
  getAll: (request, reply) => {
    models.File.findAll({
        'limit': 50
      })
      .then((files) => {
        reply(files).code(200);
      });
  },
	delete: (request, reply) => {
		// TODO: Double check that this is safe and will not delete directories
    models.File.find({
      'where': {
        'id': request.params.id
      }
    }).then((file) => {
			if (!file.locationUrl || !file.name) {
				reply(Boom.notAcceptable('File object is missing a proper locationUrl property or name property'));
			}
			let fileName = file.name;
			let locationPath = __dirname + '/../../..' + env.uploadPath + file.locationUrl;
			let locationUrl = locationPath + fileName;
      if (locationUrl.slice(-1) === '/' || locationUrl.indexOf('.') < 0) {
        reply(Boom.notAcceptable('File object is missing a proper locationUrl property or file name'));
      } else {
				let locationUrl = __dirname + '/../../..' + env.uploadPath + file.locationUrl + file.name;
        models.File.destroy({
          'where': {
            'id': request.params.id
          }
        })
        .then((fileDeleted) => {
          if (fileDeleted) {
						fse.unlink(locationUrl, (err) => {
							if (err) {
								reply(Boom.badRequest('Error deleting file.'));
								return;
							}

							// TODO: Add any file that gets duplicated and resized along with resizeConfig
							if (file.identifier === 'something') {
								let count = 0;
								imageConfig[file.identifier].sizes.forEach((size) => {
									fse.unlink(`${locationPath}/${size}-${fileName}`, (error) => {
										if (error) {
											console.log(error);
											reply(Boom.badRequest(error));
										} else {
											count++;
											if (count >= imageConfig[file.identifier].sizes.length) {
												reply().code(200);
											}
										}
									});
								});
							} else {
								reply().code(200);
							}
						});
            reply().code(404);
          }
        });
      }
    });
  }
};

module.exports = files;
