'use strict';

import models from '../../models';

// Product Route Configs
let products = {
  get: (request, reply) => {
    models.Product.find({
        'where': {
          'id': request.params.id
        }
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
    models.Product.findAll()
      .then((response) => {
        reply(response).code(200);
      });
  },
  create: (request, reply) => {
    models.Product.create({
        SKU: request.payload.SKU,
        'name': request.payload.name,
        'price': request.payload.price,
        'description': request.payload.description,
        'manufacturerId': request.payload.manufacturerId,
        'gameSystem': request.payload.gameSystem,
        'color': request.payload.color,
        'tags': request.payload.tags,
        'category': request.payload.category,
        'stockQty': request.payload.stockQty,
        'inStock': request.payload.inStock,
        'filterVal': request.payload.filterVal,
        'displayStatus': request.payload.displayStatus,
        'featured': request.payload.featured,
        'new': request.payload.new,
        'onSale': request.payload.onSale,
        'imgAlt': request.payload.imgAlt,
        'imgOneFront': request.payload.imgOneFront,
        'imgOneBack': request.payload.imgOneBack,
        'imgTwoFront': request.payload.imgTwoFront,
        'imgTwoBack': request.payload.imgTwoBack,
        'imgThreeFront': request.payload.imgThreeFront,
        'imgThreeBack': request.payload.imgThreeBack,
        'imgFourFront': request.payload.imgFourFront,
        'imgFourBack': request.payload.imgFourBack
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  update: (request, reply) => {
    models.Product.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((response) => {
        if (response) {
          response.updateAttributes({
            'SKU': request.payload.SKU,
            'name': request.payload.name,
            'price': request.payload.price,
            'description': request.payload.description,
            'manufacturerId': request.payload.manufacturerId,
            'gameSystem': request.payload.gameSystem,
            'color': request.payload.color,
            'tags': request.payload.tags,
            'category': request.payload.category,
            'stockQty': request.payload.stockQty,
            'inStock': request.payload.inStock,
            'filterVal': request.payload.filterVal,
            'displayStatus': request.payload.displayStatus,
            'featured': request.payload.featured,
            'new': request.payload.new,
            'onSale': request.payload.onSale,
            'imgAlt': request.payload.imgAlt,
            'imgOneFront': request.payload.imgOneFront,
            'imgOneBack': request.payload.imgOneBack,
            'imgTwoFront': request.payload.imgTwoFront,
            'imgTwoBack': request.payload.imgTwoBack,
            'imgThreeFront': request.payload.imgThreeFront,
            'imgThreeBack': request.payload.imgThreeBack,
            'imgFourFront': request.payload.imgFourFront,
            'imgFourBack': request.payload.imgFourBack
          }).then((response) => {
            reply(response).code(200);
          });
        } else {
          reply().code(404);
        }
      });
  },
  delete: (request, reply) => {
    models.Product.destroy({
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


export default products;
