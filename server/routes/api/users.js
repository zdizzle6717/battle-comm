'use strict';

import Joi from 'joi';
import { users } from '../handlers';
import { verifyUniqueUser, verifyCredentials, verifyUserToken, verifyUserExists } from '../../utils/userFunctions';

module.exports = [
  // User Logins
	{
    'method': 'PUT',
    'path': '/api/users/{id}/activateAccount',
    'config': {
      'tags': ['api'],
      'description': 'Activate user account',
      'notes': 'Activate user account',
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
    'handler': users.activateAccount
  },
	{
    'method': 'POST',
    'path': '/api/users/authenticate',
    'config': {
      'pre': [{
        'method': verifyCredentials,
        'assign': 'user'
      }],
      'handler': users.authenticate,
      'tags': ['api'],
      'description': 'Authenticate an existing user',
      'notes': 'Authenticate an existing user',
      'validate': {
        'payload': Joi.alternatives().try(
          Joi.object({
            'username': Joi.string().min(4).max(50).required(),
            'password': Joi.string().min(8).required(),
						'rememberMe': Joi.optional()
          }),
          Joi.object({
            'username': Joi.string().email().required(),
            'password': Joi.string().min(8).required(),
						'rememberMe': Joi.optional()
          })
        )
      }
    }
  },
	{
    'method': 'POST',
    'path': '/api/users/getMe/{token}',
    'config': {
      'pre': [{
        'method': verifyUserToken,
        'assign': 'user'
      }],
      'handler': users.authenticate,
      'tags': ['api'],
      'description': 'Authenticate an existing user from a supplied jwt',
      'notes': 'Authenticate an existing user from a supplied jwt',
      'validate': {
        'params': {
					'token': Joi.string().required()
				},
				'payload': {
					'rememberMe': Joi.boolean().required()
				}
      }
    }
  },
	{
    'method': 'PUT',
    'path': '/api/users/{id}/blockUser',
    'config': {
      'tags': ['api'],
      'description': 'Block or unblock a user',
      'notes': 'Block or unblock a user',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
				'params': {
					'id': Joi.number().required()
				},
        'payload': {
          'accountBlocked': Joi.boolean().required()
        }
      }
    },
    'handler': users.blockUser
  },
  {
    'method': 'POST',
    'path': '/api/users',
    'config': {
      'pre': [{
        'method': verifyUniqueUser
      }],
      'handler': users.create,
      'tags': ['api'],
      'description': 'Register a new user',
      'notes': 'Register a new user',
      'validate': {
        'payload': {
          'username': Joi.string().min(4).max(50).required(),
          'email': Joi.string().email().required(),
          'password': Joi.string().min(8).required(),
          'role': Joi.string().required(),
          'firstName': Joi.string().required(),
          'lastName': Joi.string().required()
        }
      }
    }
  },
  {
    'method': 'GET',
    'path': '/api/users/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Get one player by id',
      'notes': 'Get one player by id',
      'validate': {
        'params': {
          'id': Joi.number().required()
        }
      }
    },
    'handler': users.get
  },
  {
    'method': 'GET',
    'path': '/api/users/username/{username}',
    'config': {
      'tags': ['api'],
      'description': 'Get one player by username',
      'notes': 'Get one player by username',
      'validate': {
        'params': {
          'username': Joi.string().required()
        }
      }
    },
    'handler': users.get
  },
  {
    'method': 'GET',
    'path': '/api/users',
    'config': {
      'tags': ['api'],
      'description': 'Get all players',
      'notes': 'Get all players',
			'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
    },
    'handler': users.getAll
  },
  {
    'method': 'PATCH',
    'path': '/api/users/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Patch a User Login by id',
      'notes': 'Patch a User Login by id',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
        'payload': {
          'id': Joi.optional(),
          'customerId': Joi.optional(),
          'email': Joi.optional(),
          'rewardPoints': Joi.number(),
          'firstName': Joi.optional(),
          'lastName': Joi.optional(),
          'bio': Joi.optional(),
          'member': Joi.optional(),
          'subscriber': Joi.optional(),
          'tourneyAdmin': Joi.optional(),
          'eventAdmin': Joi.optional(),
          'newsContributor': Joi.optional(),
          'venueAdmin': Joi.optional(),
          'clubAdmin': Joi.optional(),
          'systemAdmin': Joi.optional(),
          'mainPhone': Joi.optional(),
          'mobilePhone': Joi.optional(),
          'streetAddress': Joi.optional(),
          'aptSuite': Joi.optional(),
          'city': Joi.optional(),
          'state': Joi.optional(),
          'zip': Joi.optional(),
          'facebook': Joi.optional(),
          'twitter': Joi.optional(),
          'instagram': Joi.optional(),
          'googlePlus': Joi.optional(),
          'twitch': Joi.optional(),
          'website': Joi.optional(),
          'username': Joi.optional(),
          'totalWins': Joi.optional(),
          'totalLosses': Joi.optional(),
          'totalDraws': Joi.optional(),
          'totalPoints': Joi.optional(),
          'eloRanking': Joi.optional(),
          'club': Joi.optional(),
          'dob': Joi.optional(),
          'youtube': Joi.optional(),
          'hasAuthenticatedOnce': Joi.optional(),
          'visibility': Joi.optional(),
          'shareContact': Joi.optional(),
          'shareName': Joi.optional(),
          'shareStatus': Joi.optional(),
          'newsletter': Joi.optional(),
          'marketing': Joi.optional(),
          'sms': Joi.optional(),
          'allowPlay': Joi.optional(),
          'accountActivated': Joi.optional(),
          'accountBlocked': Joi.optional(),
          'createdAt': Joi.optional(),
          'updatedAt': Joi.optional(),
          'UserId': Joi.optional(),
          'UserNotifications': Joi.optional(),
          'UserPhotos': Joi.optional(),
          'Friends': Joi.optional(),
          'GameSystemRankings': Joi.optional(),
					'Files': Joi.optional(),
					'UserPhoto': Joi.optional(),
					'Achievements': Joi.optional()
        }
      }
    },
    'handler': users.updatePartial
  },
  {
    'method': 'PUT',
    'path': '/api/users/{id}/updateRole',
    'config': {
      'tags': ['api'],
      'description': 'Update user role',
      'notes': 'Update user role',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
				'payload': {
					'role': Joi.string().required()
				}
      }
    },
    'handler': users.updateRole
  },
  {
    'method': 'PUT',
    'path': '/api/users/{id}/updateRP',
    'config': {
      'tags': ['api'],
      'description': 'Update user reward points',
      'notes': 'Update user reward points',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['venueAdmin', 'systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
				'payload': {
					'direction': Joi.string().valid('increment', 'decrement').required(),
					'rewardPoints': Joi.number().required()
				}
      }
    },
    'handler': users.updateRP
  },
  {
    'method': 'PUT',
    'path': '/api/users/changePassword/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Update User Password from Account Dashboard',
      'notes': 'Update User Password from Account Dashboard',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
        'payload': {
          'username': Joi.string().required(),
          'password': Joi.string().min(8).required(),
          'newPassword': Joi.string().required()
        }
      },
      'pre': [{
        'method': verifyCredentials
      }],
      'handler': users.changePassword
    }
  },
  {
    'method': 'POST',
    'path': '/api/users/resetPassword/',
    'config': {
      'tags': ['api'],
      'description': 'Send E-mail to Reset Password',
      'notes': 'Send E-mail to Reset Password',
      'validate': {
        'payload': {
          'email': Joi.string().required()
        }
      },
      'pre': [{
        'method': verifyUserExists,
        'assign': 'user'
      }],
      'handler': users.resetPassword
    }
  },
  {
    'method': 'POST',
    'path': '/api/users/verifyResetToken/{token}',
    'config': {
      'tags': ['api'],
      'description': 'Verify Reset Token is Valid',
      'notes': 'Verify Reset Token is Valid',
      'validate': {
        'params': {
          'token': Joi.string().required()
        }
      },
      'handler': users.verifyResetToken
    }
  },
  {
    'method': 'POST',
    'path': '/api/users/setNewPassword/{token}',
    'config': {
      'tags': ['api'],
      'description': 'Update Password After Forgot E-mail Password Confirmation',
      'notes': 'Update Password After Forgot E-mail Password Confirmation',
      'validate': {
        'params': {
          'token': Joi.string().required()
        },
        'payload': {
          'email': Joi.string().required(),
          'password': Joi.string().min(8).required()
        }
      },
      'handler': users.setNewPassword
    }
  },
  {
    'method': 'POST',
    'path': '/api/search/users',
    'config': {
      'tags': ['api'],
      'description': 'Return User/Player search results',
      'notes': 'Return User/Player search results',
      'validate': {
				'payload': {
          'maxResults': Joi.optional(),
          'searchQuery': Joi.optional(),
					'searchBy': Joi.optional(),
					'orderBy': Joi.string().required(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    },
    'handler': users.search
  },
  {
    'method': 'POST',
    'path': '/api/search/users/suggestions',
    'config': {
      'tags': ['api'],
      'description': 'Search for user suggestions based on criteria',
      'notes': 'Search for user suggestions based on criteria',
			'validate': {
        'payload': {
          'searchQuery': Joi.optional(),
          'maxResults': Joi.number().required()
        }
      }
    },
    'handler': users.searchSuggestions
  },
];
