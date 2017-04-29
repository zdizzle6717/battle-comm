'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Product Route Configs
var bannerSlides = {
  get: function get(request, reply) {
    _models2.default.BannerSlide.find({
      'where': {
        'id': request.params.id
      },
      'include': [{
        'model': _models2.default.File
      }]
    }).then(function (response) {
      if (response) {
        reply(response).code(200);
      } else {
        reply().code(404);
      }
    });
  },
  getAll: function getAll(request, reply) {
    _models2.default.BannerSlide.findAll({
      'include': [{
        'model': _models2.default.File
      }]
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  create: function create(request, reply) {
    _models2.default.BannerSlide.create({
      'actionText': request.payload.actionText,
      'pageName': request.payload.pageName,
      'title': request.payload.title,
      'text': request.payload.text,
      'priority': request.payload.priority,
      'link': request.payload.link,
      'isActive': request.payload.isActive
    }).then(function (slide) {
      _models2.default.BannerSlide.find({
        'where': {
          'id': slide.id
        },
        'include': {
          'model': _models2.default.File
        }
      }).then(function (slide) {
        reply(slide).code(200);
      });
    });
  },
  update: function update(request, reply) {
    _models2.default.BannerSlide.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (bannerSlide) {
      if (bannerSlide) {
        bannerSlide.updateAttributes({
          'actionText': request.payload.actionText,
          'pageName': request.payload.pageName,
          'title': request.payload.title,
          'text': request.payload.text,
          'priority': request.payload.priority,
          'link': request.payload.link,
          'isActive': request.payload.isActive
        }).then(function (slide) {
          _models2.default.BannerSlide.find({
            'where': {
              'id': slide.id
            },
            'include': {
              'model': _models2.default.File
            }
          }).then(function (slide) {
            reply(slide).code(200);
          });
        });
      } else {
        reply().code(404);
      }
    });
  },
  delete: function _delete(request, reply) {
    _models2.default.BannerSlide.destroy({
      'where': {
        'id': request.params.id
      }
    }).then(function (response) {
      if (response) {
        reply().code(200);
      } else {
        reply().code(404);
      }
    });
  }
};

exports.default = bannerSlides;