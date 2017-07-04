'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

var _boom = require('boom');

var _boom2 = _interopRequireDefault(_boom);

var _fsExtra = require('fs-extra');

var _fsExtra2 = _interopRequireDefault(_fsExtra);

var _envVariables = require('../../../envVariables');

var _envVariables2 = _interopRequireDefault(_envVariables);

var _imageConfig = require('../../constants/imageConfig');

var _imageConfig2 = _interopRequireDefault(_imageConfig);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Product Route Configs
var userPhotos = {
    create: function create(request, reply) {
        _models2.default.UserPhoto.create({
            'UserId': request.payload.UserId,
            'locationUrl': request.payload.locationUrl,
            'identifier': request.payload.identifier,
            'label': request.payload.label,
            'name': request.payload.name,
            'size': request.payload.size,
            'type': request.payload.type
        }).then(function (userPhoto) {
            reply(userPhoto).code(200);
        });
    },
    update: function update(request, reply) {
        _models2.default.UserPhoto.find({
            'where': {
                'id': request.params.id
            }
        }).then(function (userPhoto) {
            if (userPhoto) {
                userPhoto.updateAttributes({
                    'UserId': request.payload.UserId,
                    'identifier': request.payload.identifier,
                    'locationUrl': request.payload.locationUrl,
                    'label': request.payload.label,
                    'name': request.payload.name,
                    'size': request.payload.size,
                    'type': request.payload.type
                }).then(function (userPhoto) {
                    reply(userPhoto).code(200);
                });
            } else {
                reply().code(404);
            }
        });
    },
    delete: function _delete(request, reply) {
        // TODO: Double check that this is safe and will not delete directories
        _models2.default.UserPhoto.find({
            'where': {
                'id': request.params.id
            }
        }).then(function (userPhoto) {
            if (!userPhoto.locationUrl || !userPhoto.name) {
                reply(_boom2.default.notAcceptable('UserPhoto object is missing a proper locationUrl property or file name'));
            }
            var fileName = userPhoto.name;
            var locationPath = __dirname + '/../../../dist' + userPhoto.locationUrl;
            var locationUrl = locationPath + fileName;
            if (locationUrl.slice(-1) === '/' || locationUrl.indexOf('.') < 0) {
                reply(_boom2.default.notAcceptable('UserPhoto object is missing a proper locationUrl property or file name'));
            } else {
                // Delete files
                _models2.default.UserPhoto.destroy({
                    'where': {
                        'id': request.params.id
                    }
                }).then(function (file) {
                    if (file) {
                        _fsExtra2.default.unlink(locationUrl, function (err) {
                            if (err) {
                                reply(_boom2.default.badRequest('Error deleting user photo file.'));
                            } else {
                                var count = 0;
                                _imageConfig2.default[userPhoto.identifier].sizes.forEach(function (size) {
                                    _fsExtra2.default.unlink(locationPath + '/' + size + '-' + fileName, function (error) {
                                        if (error) {
                                            console.log(error);
                                            reply(_boom2.default.badRequest('Error deleting user photo file.'));
                                        } else {
                                            count++;
                                            if (count >= _imageConfig2.default[userPhoto.identifier].sizes.length) {
                                                reply().code(200);
                                            }
                                        }
                                    });
                                });
                            }
                        });
                    } else {
                        reply(_boom2.default.notFound('File missing, cannot delete.'));
                    }
                });
            }
        });
    }
};

exports.default = userPhotos;