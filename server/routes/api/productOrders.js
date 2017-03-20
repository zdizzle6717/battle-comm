'use strict';

import Joi from 'joi';
import { productOrders } from '../handlers';

module.exports = [
  // Product Orders
  {
    'method': 'GET',
    'path': '/api/productOrders/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Get one productOrder by id',
      'notes': 'Get one productOrder by id',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        }
      }
    },
    'handler': productOrders.get
  },
  {
    'method': 'GET',
    'path': '/api/productOrders',
    'config': {
      'tags': ['api'],
      'description': 'Get all productOrders',
      'notes': 'Get all productOrders',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
    },
    'handler': productOrders.getAll
  },
  {
    'method': 'POST',
    'path': '/api/productOrders',
    'config': {
      'tags': ['api'],
      'description': 'Add a new productOrder',
      'notes': 'Add a new productOrder',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'validate': {
        'payload': {
          'status': Joi.string().required(),
          'orderDetails': Joi.string().required(),
          'orderTotal': Joi.number().required(),
          'UserId': Joi.number().required(),
          'customerFullName': Joi.string().required(),
          'customerEmail': Joi.string().email().required(),
          'phone': Joi.optional(),
          'shippingStreet': Joi.string().required(),
          'shippingAppartment': Joi.optional(),
          'shippingCity': Joi.string().required(),
          'shippingState': Joi.string().required(),
          'shippingZip': Joi.string().required(),
          'shippingCountry': Joi.string().required()
        }
      }
    },
    'handler': productOrders.create
  },
  {
    'method': 'PUT',
    'path': '/api/productOrders/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Update a productOrder by id',
      'notes': 'Update a productOrder by id',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
        'payload': {
          'status': Joi.string().required(),
          'orderDetails': Joi.string().required(),
          'orderTotal': Joi.number().required(),
          'UserId': Joi.number().required(),
          'customerFullName': Joi.string().required(),
          'customerEmail': Joi.string().email().required(),
          'phone': Joi.optional(),
          'shippingStreet': Joi.string().required(),
          'shippingAppartment': Joi.optional(),
          'shippingCity': Joi.string().required(),
          'shippingState': Joi.string().required(),
          'shippingZip': Joi.string().required(),
          'shippingCountry': Joi.string().required()
        }
      }
    },
    'handler': productOrders.update
  },
  {
    'method': 'DELETE',
    'path': '/api/productOrders/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Delete a productOrder by id',
      'notes': 'Delete a productOrder by id',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        }
      }
    },
    'handler': productOrders.delete
  }
];
