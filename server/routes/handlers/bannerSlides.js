'use strict';

import models from '../../models';

// Product Route Configs
let bannerSlides = {
  get: (request, reply) => {
    models.BannerSlide.find({
        'where': {
          'id': request.params.id
        },
        'include': [{
          'model': models.File
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
    models.BannerSlide.findAll({
        'include': [{
          'model': models.File
        }]
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  create: (request, reply) => {
    models.BannerSlide.create({
        'actionText': request.payload.actionText,
        'pageName': request.payload.pageName,
        'title': request.payload.title,
        'text': request.payload.text,
        'priority': request.payload.priority,
        'link': request.payload.link,
        'isActive': request.payload.isActive
      })
      .then((slide) => {
				models.BannerSlide.find({
					'where': {
						'id': slide.id
					},
					'include': {
						'model': models.File
					}
				}).then((slide) => {
					reply(slide).code(200);
				});
      });
  },
  update: (request, reply) => {
    models.BannerSlide.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((bannerSlide) => {
        if (bannerSlide) {
          bannerSlide.updateAttributes({
						'actionText': request.payload.actionText,
						'pageName': request.payload.pageName,
						'title': request.payload.title,
		        'text': request.payload.text,
		        'priority': request.payload.priority,
		        'link': request.payload.link,
		        'isActive': request.payload.isActive
          }).then((slide) => {
						models.BannerSlide.find({
							'where': {
								'id': slide.id
							},
							'include': {
								'model': models.File
							}
						}).then((slide) => {
							reply(slide).code(200);
						});
		      });
        } else {
          reply().code(404);
        }
      });
  },
  delete: (request, reply) => {
    models.BannerSlide.destroy({
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

export default bannerSlides;
