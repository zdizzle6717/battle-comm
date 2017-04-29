'use strict';

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

var _fsExtra = require('fs-extra');

var _fsExtra2 = _interopRequireDefault(_fsExtra);

var _envVariables = require('../../../envVariables.js');

var _envVariables2 = _interopRequireDefault(_envVariables);

var _imageConfig = require('../../constants/imageConfig');

var _imageConfig2 = _interopRequireDefault(_imageConfig);

var _boom = require('boom');

var _boom2 = _interopRequireDefault(_boom);

var _imagemagickStream = require('imagemagick-stream');

var _imagemagickStream2 = _interopRequireDefault(_imagemagickStream);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// TODO: Switch to npm package 'gm' for image modification
// TODO: Figure out why imagemagick-stream is not properly resizing images

// File Upload Route Configs
var files = {
  create: function create(request, reply) {
    _models2.default.File.create({
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
    }).then(function (file) {
      reply(file).code(200);
    });
  },
  update: function update(request, reply) {
    _models2.default.File.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (file) {
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
        }).then(function (file) {
          reply(file).code(200);
        });
      } else {
        reply().code(404);
      }
    });
  },
  add: function add(request, reply) {
    var data = request.payload;
    if (!data.path || !data.fileSize) {
      reply(_boom2.default.badRequest('A \'path\' and \'fileSize\' attribute must be appended to the FormData object'));
    } else if (data.file) {

      // Handle any image resizing and duplication here
      var resizeArray = [];
      if (data.identifier === 'playerIcon') {
        _imageConfig2.default[data.identifier].sizes.forEach(function (size) {
          resizeArray.push({
            'name': size + '-' + data.file.hapi.filename,
            'resize': (0, _imagemagickStream2.default)().resize(size + 'x' + size + '!').quality(100)
          });
        });
      }

      var filename = data.file.hapi.filename;
      var location = __dirname + '/../../..' + _envVariables2.default.uploadPath + data.path;
      var path = location + filename;

      // Using ensureDir instead of ensureFile allow us to overwrite files if they already exist
      _fsExtra2.default.ensureDir(location, function (err) {
        if (err) {
          reply(_boom2.default.notAcceptable('An error occured during ensureDir'));
          return;
        }

        // Create the initial file to read from
        var file = _fsExtra2.default.createWriteStream(path);
        data.file.pipe(file);
        data.file.on('end', function (err) {
          if (err) {
            reply(_boom2.default.notAcceptable('An error occured on file end (resizeArray loop)'));
            return;
          }

          // TODO: Double check that type is correct
          var successResponse = {
            'file': {
              'name': filename,
              'size': data.fileSize,
              'type': data.file.hapi.headers['content-type'],
              'locationUrl': _envVariables2.default.uploadPath + data.path
            },
            'filename': data.file.hapi.filename,
            'headers': data.file.hapi.headers,
            'status': 200,
            'statusText': 'File uploaded successfully!'
          };

          if (resizeArray.length > 0) {
            var count = 0;
            resizeArray.forEach(function (resizeConfig) {
              var read = _fsExtra2.default.createReadStream(path);
              var resizePath = location + resizeConfig.name;
              var write = _fsExtra2.default.createWriteStream(resizePath);
              read.pipe(resizeConfig.resize).pipe(write);

              read.on('end', function (err) {
                if (err) {
                  reply(_boom2.default.notAcceptable('An error occured on file end (resizeArray loop)'));
                  return;
                }
                // Set file folder permissions and owners/groups just for safe measure
                _fsExtra2.default.chownSync(location, _envVariables2.default.serverUID, _envVariables2.default.serverGID);
                _fsExtra2.default.chmodSync(location, '0775');

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
            _fsExtra2.default.chown(location, _envVariables2.default.serverUID, _envVariables2.default.serverGID, function (err) {
              if (err) {
                reply(_boom2.default.notAcceptable('chown: ' + err));
                return;
              }
              _fsExtra2.default.chmod(location, '0775', function (err) {
                if (err) {
                  reply(_boom2.default.notAcceptable('chown: ' + err));
                  return;
                }

                reply(JSON.stringify(successResponse));
              });
            });
          }
        });
      });
    } else {
      reply(_boom2.default.badRequest('There was an error uploading your file.'));
    }
  },
  getAll: function getAll(request, reply) {
    _models2.default.File.findAll({
      'limit': 50
    }).then(function (files) {
      reply(files).code(200);
    });
  },
  delete: function _delete(request, reply) {
    // TODO: Double check that this is safe and will not delete directories
    _models2.default.File.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (file) {
      if (!file.locationUrl || !file.name) {
        reply(_boom2.default.notAcceptable('File object is missing a proper locationUrl property or name property'));
      }
      var fileName = file.name;
      var locationPath = __dirname + '/../../..' + _envVariables2.default.uploadPath + file.locationUrl;
      var locationUrl = locationPath + fileName;
      if (locationUrl.slice(-1) === '/' || locationUrl.indexOf('.') < 0) {
        reply(_boom2.default.notAcceptable('File object is missing a proper locationUrl property or file name'));
      } else {
        var _locationUrl = __dirname + '/../../..' + _envVariables2.default.uploadPath + file.locationUrl + file.name;
        _models2.default.File.destroy({
          'where': {
            'id': request.params.id
          }
        }).then(function (fileDeleted) {
          if (fileDeleted) {
            _fsExtra2.default.unlink(_locationUrl, function (err) {
              if (err) {
                reply(_boom2.default.badRequest('Error deleting file.'));
                return;
              }

              // TODO: Add any file that gets duplicated and resized along with resizeConfig
              if (file.identifier === 'something') {
                var count = 0;
                _imageConfig2.default[file.identifier].sizes.forEach(function (size) {
                  _fsExtra2.default.unlink(locationPath + '/' + size + '-' + fileName, function (error) {
                    if (error) {
                      console.log(error);
                      reply(_boom2.default.badRequest(error));
                    } else {
                      count++;
                      if (count >= _imageConfig2.default[file.identifier].sizes.length) {
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