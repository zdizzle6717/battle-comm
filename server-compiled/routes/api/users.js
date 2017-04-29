'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

var _userFunctions = require('../../utils/userFunctions');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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
        'id': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.users.activateAccount
}, {
  'method': 'POST',
  'path': '/api/users/authenticate',
  'config': {
    'pre': [{
      'method': _userFunctions.verifyCredentials,
      'assign': 'user'
    }],
    'handler': _handlers.users.authenticate,
    'tags': ['api'],
    'description': 'Authenticate an existing user',
    'notes': 'Authenticate an existing user',
    'validate': {
      'payload': _joi2.default.alternatives().try(_joi2.default.object({
        'username': _joi2.default.string().min(4).max(50).required(),
        'password': _joi2.default.string().min(8).required(),
        'rememberMe': _joi2.default.optional()
      }), _joi2.default.object({
        'username': _joi2.default.string().email().required(),
        'password': _joi2.default.string().min(8).required(),
        'rememberMe': _joi2.default.optional()
      }))
    }
  }
}, {
  'method': 'POST',
  'path': '/api/users/getMe/{token}',
  'config': {
    'pre': [{
      'method': _userFunctions.verifyUserToken,
      'assign': 'user'
    }],
    'handler': _handlers.users.authenticate,
    'tags': ['api'],
    'description': 'Authenticate an existing user from a supplied jwt',
    'notes': 'Authenticate an existing user from a supplied jwt',
    'validate': {
      'params': {
        'token': _joi2.default.string().required()
      },
      'payload': {
        'rememberMe': _joi2.default.boolean().required()
      }
    }
  }
}, {
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
        'id': _joi2.default.number().required()
      },
      'payload': {
        'accountBlocked': _joi2.default.boolean().required()
      }
    }
  },
  'handler': _handlers.users.blockUser
}, {
  'method': 'POST',
  'path': '/api/users',
  'config': {
    'pre': [{
      'method': _userFunctions.verifyUniqueUser
    }],
    'handler': _handlers.users.create,
    'tags': ['api'],
    'description': 'Register a new user',
    'notes': 'Register a new user',
    'validate': {
      'payload': {
        'username': _joi2.default.string().min(4).max(50).required(),
        'email': _joi2.default.string().email().required(),
        'password': _joi2.default.string().min(8).required(),
        'role': _joi2.default.string().required(),
        'firstName': _joi2.default.string().required(),
        'lastName': _joi2.default.string().required()
      }
    }
  }
}, {
  'method': 'GET',
  'path': '/api/users/{id}',
  'config': {
    'tags': ['api'],
    'description': 'Get one player by id',
    'notes': 'Get one player by id',
    'validate': {
      'params': {
        'id': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.users.get
}, {
  'method': 'GET',
  'path': '/api/users/username/{username}',
  'config': {
    'tags': ['api'],
    'description': 'Get one player by username',
    'notes': 'Get one player by username',
    'validate': {
      'params': {
        'username': _joi2.default.string().required()
      }
    }
  },
  'handler': _handlers.users.get
}, {
  'method': 'GET',
  'path': '/api/users',
  'config': {
    'tags': ['api'],
    'description': 'Get all players',
    'notes': 'Get all players',
    'auth': {
      'strategy': 'jsonWebToken',
      'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
    }
  },
  'handler': _handlers.users.getAll
}, {
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
        'id': _joi2.default.number().required()
      },
      'payload': {
        'id': _joi2.default.optional(),
        'email': _joi2.default.optional(),
        'rewardPoints': _joi2.default.number(),
        'firstName': _joi2.default.optional(),
        'lastName': _joi2.default.optional(),
        'bio': _joi2.default.optional(),
        'member': _joi2.default.optional(),
        'subscriber': _joi2.default.optional(),
        'tourneyAdmin': _joi2.default.optional(),
        'eventAdmin': _joi2.default.optional(),
        'newsContributor': _joi2.default.optional(),
        'venueAdmin': _joi2.default.optional(),
        'clubAdmin': _joi2.default.optional(),
        'systemAdmin': _joi2.default.optional(),
        'mainPhone': _joi2.default.optional(),
        'mobilePhone': _joi2.default.optional(),
        'streetAddress': _joi2.default.optional(),
        'aptSuite': _joi2.default.optional(),
        'city': _joi2.default.optional(),
        'state': _joi2.default.optional(),
        'zip': _joi2.default.optional(),
        'facebook': _joi2.default.optional(),
        'twitter': _joi2.default.optional(),
        'instagram': _joi2.default.optional(),
        'googlePlus': _joi2.default.optional(),
        'twitch': _joi2.default.optional(),
        'website': _joi2.default.optional(),
        'username': _joi2.default.optional(),
        'totalWins': _joi2.default.optional(),
        'totalLosses': _joi2.default.optional(),
        'totalDraws': _joi2.default.optional(),
        'totalPoints': _joi2.default.optional(),
        'eloRanking': _joi2.default.optional(),
        'club': _joi2.default.optional(),
        'dob': _joi2.default.optional(),
        'youtube': _joi2.default.optional(),
        'visibility': _joi2.default.optional(),
        'shareContact': _joi2.default.optional(),
        'shareName': _joi2.default.optional(),
        'shareStatus': _joi2.default.optional(),
        'newsletter': _joi2.default.optional(),
        'marketing': _joi2.default.optional(),
        'sms': _joi2.default.optional(),
        'allowPlay': _joi2.default.optional(),
        'accountActivated': _joi2.default.optional(),
        'accountBlocked': _joi2.default.optional(),
        'createdAt': _joi2.default.optional(),
        'updatedAt': _joi2.default.optional(),
        'UserId': _joi2.default.optional(),
        'UserNotifications': _joi2.default.optional(),
        'UserPhotos': _joi2.default.optional(),
        'Friends': _joi2.default.optional(),
        'GameSystemRankings': _joi2.default.optional(),
        'Files': _joi2.default.optional(),
        'UserPhoto': _joi2.default.optional()
      }
    }
  },
  'handler': _handlers.users.updatePartial
}, {
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
        'id': _joi2.default.number().required()
      },
      'payload': {
        'role': _joi2.default.string().required()
      }
    }
  },
  'handler': _handlers.users.updateRole
}, {
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
        'id': _joi2.default.number().required()
      },
      'payload': {
        'direction': _joi2.default.string().valid('increment', 'decrement').required(),
        'rewardPoints': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.users.updateRP
}, {
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
        'id': _joi2.default.number().required()
      },
      'payload': {
        'username': _joi2.default.string().required(),
        'password': _joi2.default.string().min(8).required(),
        'newPassword': _joi2.default.string().required()
      }
    },
    'pre': [{
      'method': _userFunctions.verifyCredentials
    }],
    'handler': _handlers.users.changePassword
  }
}, {
  'method': 'POST',
  'path': '/api/users/resetPassword/',
  'config': {
    'tags': ['api'],
    'description': 'Send E-mail to Reset Password',
    'notes': 'Send E-mail to Reset Password',
    'validate': {
      'payload': {
        'email': _joi2.default.string().required()
      }
    },
    'pre': [{
      'method': _userFunctions.verifyUserExists,
      'assign': 'user'
    }],
    'handler': _handlers.users.resetPassword
  }
}, {
  'method': 'POST',
  'path': '/api/users/verifyResetToken/{token}',
  'config': {
    'tags': ['api'],
    'description': 'Verify Reset Token is Valid',
    'notes': 'Verify Reset Token is Valid',
    'validate': {
      'params': {
        'token': _joi2.default.string().required()
      }
    },
    'handler': _handlers.users.verifyResetToken
  }
}, {
  'method': 'POST',
  'path': '/api/users/setNewPassword/{token}',
  'config': {
    'tags': ['api'],
    'description': 'Update Password After Forgot E-mail Password Confirmation',
    'notes': 'Update Password After Forgot E-mail Password Confirmation',
    'validate': {
      'params': {
        'token': _joi2.default.string().required()
      },
      'payload': {
        'email': _joi2.default.string().required(),
        'password': _joi2.default.string().min(8).required()
      }
    },
    'handler': _handlers.users.setNewPassword
  }
}, {
  'method': 'POST',
  'path': '/api/search/users',
  'config': {
    'tags': ['api'],
    'description': 'Return User/Player search results',
    'notes': 'Return User/Player search results',
    'validate': {
      'payload': {
        'maxResults': _joi2.default.optional(),
        'searchQuery': _joi2.default.optional(),
        'searchBy': _joi2.default.optional(),
        'orderBy': _joi2.default.string().required(),
        'pageNumber': _joi2.default.number().required(),
        'pageSize': _joi2.default.optional()
      }
    }
  },
  'handler': _handlers.users.search
}, {
  'method': 'POST',
  'path': '/api/search/users/suggestions',
  'config': {
    'tags': ['api'],
    'description': 'Search for user suggestions based on criteria',
    'notes': 'Search for user suggestions based on criteria',
    'validate': {
      'payload': {
        'searchQuery': _joi2.default.optional(),
        'maxResults': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.users.searchSuggestions
}];