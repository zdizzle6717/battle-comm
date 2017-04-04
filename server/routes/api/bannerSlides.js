'use strict';

import Joi from 'joi';
import { bannerSlides } from '../handlers';

module.exports = [
	// News Posts
	{
		'method': 'GET',
		'path': '/api/bannerSlides/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Get one bannerSlide by id',
			'notes': 'Get one bannerSlide by id',
			'validate': {
				'params': {
					'id': Joi.number().required()
				}
			}
		},
		'handler': bannerSlides.get
	},
	{
		'method': 'GET',
		'path': '/api/bannerSlides',
		'config': {
			'tags': ['api'],
			'description': 'Get all bannerSlides',
			'notes': 'Get all bannerSlides'
		},
		'handler': bannerSlides.getAll
	},
	{
		'method': 'POST',
		'path': '/api/bannerSlides',
		'config': {
			'tags': ['api'],
			'description': 'Add a new bannerSlide',
			'notes': 'Add a new bannerSlide',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['newsContributor', 'systemAdmin']
			},
			'validate': {
				'payload': {
					'title': Joi.string().required(),
					'text': Joi.string().required(),
					'pageName': Joi.string().required(),
					'priority': Joi.number().required(),
					'link': Joi.optional(),
					'isActive': Joi.optional()
				}
			}
		},
		'handler': bannerSlides.create
	},
	{
		'method': 'PUT',
		'path': '/api/bannerSlides/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Update a bannerSlide by id',
			'notes': 'Update a bannerSlide by id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['newsContributor', 'systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				},
				'payload': {
					'title': Joi.string().required(),
					'text': Joi.string().required(),
					'pageName': Joi.string().required(),
					'priority': Joi.number().required(),
					'link': Joi.optional(),
					'isActive': Joi.optional()
				}
			}
		},
		'handler': bannerSlides.update
	},
	{
		'method': 'DELETE',
		'path': '/api/bannerSlides/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Delete a bannerSlide by id',
			'notes': 'Delete a bannerSlide by id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['newsContributor', 'systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				}
			}
		},
		'handler': bannerSlides.delete
	}
];
