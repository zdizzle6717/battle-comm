'use strict';

import Joi from 'joi';
import { newsPosts } from '../handlers';

module.exports = [
	// News Posts
	{
		'method': 'GET',
		'path': '/api/newsPosts/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Get one newsPost by id',
			'notes': 'Get one newsPost by id',
			'validate': {
				'params': {
					'id': Joi.number().required()
				}
			}
		},
		'handler': newsPosts.get
	},
	{
		'method': 'GET',
		'path': '/api/newsPosts',
		'config': {
			'tags': ['api'],
			'description': 'Get all newsPosts',
			'notes': 'Get all newsPosts'
		},
		'handler': newsPosts.getAll
	},
	{
		'method': 'POST',
		'path': '/api/newsPosts',
		'config': {
			'tags': ['api'],
			'description': 'Add a new newsPost',
			'notes': 'Add a new newsPost',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['newsContributor', 'systemAdmin']
			},
			'validate': {
				'payload': {
					'UserId': Joi.number().required(),
					'title': Joi.string().required(),
					'callout': Joi.string().required(),
					'body': Joi.string().required(),
					'published': Joi.boolean().required(),
					'featured': Joi.boolean().required(),
					'tags': Joi.optional(),
					'manufacturerId': Joi.optional(),
					'gameSystemId': Joi.optional(),
					'category': Joi.string().required()
				}
			}
		},
		'handler': newsPosts.create
	},
	{
		'method': 'PUT',
		'path': '/api/newsPosts/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Update a newsPost by id',
			'notes': 'Update a newsPost by id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['newsContributor', 'systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				},
				'payload': {
					'UserId': Joi.number().required(),
					'title': Joi.string().required(),
					'callout': Joi.string().required(),
					'body': Joi.string().required(),
					'published': Joi.boolean().required(),
					'featured': Joi.boolean().required(),
					'tags': Joi.optional(),
					'manufacturerId': Joi.optional(),
					'gameSystemId': Joi.optional(),
					'category': Joi.string().required()
				}
			}
		},
		'handler': newsPosts.update
	},
	{
    'method': 'POST',
    'path': '/api/search/newsPosts',
    'config': {
      'tags': ['api'],
      'description': 'Return News Post search results',
      'notes': 'Return News Post search results',
      'validate': {
        'payload': {
          'maxResults': Joi.optional(),
          'searchQuery': Joi.optional(),
					'searchBy': Joi.optional(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    },
    'handler': newsPosts.search
  },
	{
		'method': 'DELETE',
		'path': '/api/newsPosts/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Delete a newsPost by id',
			'notes': 'Delete a newsPost by id',
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
		'handler': newsPosts.delete
	}
];
