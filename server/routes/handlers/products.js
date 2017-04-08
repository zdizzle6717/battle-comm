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
        'FactionId': request.payload.FactionId,
        'GameSystemId': request.payload.GameSystemId,
        'ManufacturerId': request.payload.ManufacturerId,
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
        'isInStock': request.payload.isInStock,
        'filterVal': request.payload.filterVal,
        'isDisplayed': request.payload.isDisplayed,
        'isFeatured': request.payload.isFeatured,
        'isNew': request.payload.isNew,
        'isOnSale': request.payload.isOnSale
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
            'FactionId': request.payload.FactionId,
            'GameSystemId': request.payload.GameSystemId,
            'ManufacturerId': request.payload.ManufacturerId,
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
            'isInStock': request.payload.isInStock,
            'filterVal': request.payload.filterVal,
            'isDisplayed': request.payload.isDisplayed,
            'isFeatured': request.payload.isFeatured,
            'isNew': request.payload.isNew,
            'isOnSale': request.payload.isOnSale
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
