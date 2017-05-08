'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _envVariables = require('../../../envVariables');

var _envVariables2 = _interopRequireDefault(_envVariables);

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

var _boom = require('boom');

var _boom2 = _interopRequireDefault(_boom);

var _nodemailer = require('nodemailer');

var _nodemailer2 = _interopRequireDefault(_nodemailer);

var _rpUpdate = require('../../email-templates/rpUpdate');

var _rpUpdate2 = _interopRequireDefault(_rpUpdate);

var _buildRegistrationEmail = require('../../email-templates/buildRegistrationEmail');

var _buildRegistrationEmail2 = _interopRequireDefault(_buildRegistrationEmail);

var _forgotPassword = require('../../email-templates/forgotPassword');

var _forgotPassword2 = _interopRequireDefault(_forgotPassword);

var _passwordUpdated = require('../../email-templates/passwordUpdated');

var _passwordUpdated2 = _interopRequireDefault(_passwordUpdated);

var _createUserToken = require('../../utils/createUserToken');

var _createUserToken2 = _interopRequireDefault(_createUserToken);

var _createResetToken = require('../../utils/createResetToken');

var _createResetToken2 = _interopRequireDefault(_createResetToken);

var _verifyResetToken2 = require('../../utils/verifyResetToken');

var _verifyResetToken3 = _interopRequireDefault(_verifyResetToken2);

var _userFunctions = require('../../utils/userFunctions');

var _roleConfig = require('../../../roleConfig');

var _roleConfig2 = _interopRequireDefault(_roleConfig);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var transporter = _nodemailer2.default.createTransport({
  'service': 'Gmail',
  'auth': {
    'type': 'OAuth2',
    'clientId': _envVariables2.default.email.OAuth2.clientId,
    'clientSecret': _envVariables2.default.email.OAuth2.clientSecret
  }
});

var getUserModel = function getUserModel(where) {
  return _models2.default.User.find({
    'where': where,
    'attributes': {
      'exclude': ['password']
    },
    'include': [{
      'model': _models2.default.UserNotification
    }, {
      'model': _models2.default.UserPhoto
    }, {
      'model': _models2.default.User,
      'as': 'Friends',
      'attributes': ['id', 'firstName', 'lastName', 'username'],
      'include': [{
        'model': _models2.default.UserPhoto
      }]
    }, {
      'model': _models2.default.GameSystemRanking,
      'include': [{
        'model': _models2.default.GameSystem,
        'attributes': ['name']
      }, {
        'model': _models2.default.FactionRanking,
        'include': [{
          'model': _models2.default.Faction,
          'attributes': ['name']
        }]
      }]
    }, {
      'model': _models2.default.File
    }]
  });
};

// Product Route Configs
var users = {
  activateAccount: function activateAccount(request, reply) {
    _models2.default.User.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (user) {
      if (user) {
        user.updateAttributes({
          'accountActivated': true
        }).then(function (user) {
          reply(user).code(200);
        });
      } else {
        reply().code(404);
      }
    }).catch(function (err) {
      console.log(err);
    });
  },
  authenticate: function authenticate(request, reply) {
    reply({
      'username': request.pre.user.username,
      'email': request.pre.user.email,
      'id_token': (0, _createUserToken2.default)(request.pre.user, request.payload.rememberMe),
      'roleFlags': (0, _userFunctions.getUserRoleFlags)(request.pre.user),
      'id': request.pre.user.id,
      'customerId': request.pre.user.customerId,
      'firstName': request.pre.user.firstName,
      'lastName': request.pre.user.lastName,
      'member': request.pre.user.member,
      'subscriber': request.pre.user.subscriber,
      'tourneyAdmin': request.pre.user.tourneyAdmin,
      'eventAdmin': request.pre.user.eventAdmin,
      'newsContributor': request.pre.user.newsContributor,
      'venueAdmin': request.pre.user.venueAdmin,
      'clubAdmin': request.pre.user.clubAdmin,
      'systemAdmin': request.pre.user.systemAdmin,
      'accountActivated': request.pre.user.accountActivated,
      'rewardPoints': request.pre.user.rewardPoints,
      'UserPhoto': request.pre.user.UserPhoto
    }).code(201);
  },
  blockUser: function blockUser(request, reply) {
    _models2.default.User.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (user) {
      if (user) {
        user.updateAttributes({
          'accountBlocked': request.payload.accountBlocked
        }).then(function (user) {
          getUserModel({
            'id': user.id
          }).then(function (user) {
            reply(user).code(200);
          });
        });
      } else {
        reply().code(404);
      }
    }).catch(function (err) {
      console.log(err);
    });
  },
  get: function get(request, reply) {
    var where = {};
    if (request.params.id) {
      where = {
        'id': request.params.id
      };
    } else if (request.params.username) {
      where = {
        'username': request.params.username
      };
    }
    getUserModel(where).then(function (response) {
      if (response) {
        reply(response).code(200);
      } else {
        reply().code(404);
      }
    });
  },
  getAll: function getAll(request, reply) {
    _models2.default.User.findAll({
      'include': [{
        'model': _models2.default.File
      }]
    }).then(function (products) {
      reply(products).code(200);
    });
  },
  create: function create(request, reply) {
    (0, _userFunctions.hashPassword)(request.payload.password, function (err, hash) {
      var userConfig = {
        'email': request.payload.email,
        'firstName': request.payload.firstName,
        'lastName': request.payload.lastName,
        'username': request.payload.username,
        'password': hash,
        'accountActivated': request.payload.role === 'member'
      };
      _roleConfig2.default.forEach(function (role) {
        if (role.name !== 'public') {
          userConfig[role.name] = false;
        }
      });
      userConfig[request.payload.role] = true;
      _models2.default.User.create(userConfig).then(function (user) {
        user = user.get({ 'plain': true });
        // Send confirmation e-mail
        var customerMailConfig = {
          'from': _envVariables2.default.email.user,
          'to': user.email,
          'subject': 'Welcome to Battle-Comm!',
          'html': (0, _buildRegistrationEmail2.default)(request.payload.role, user),
          'service': 'Gmail',
          'auth': {
            'user': _envVariables2.default.email.user,
            'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
          }
        };

        transporter.sendMail(customerMailConfig, function (error, info) {
          if (error) {
            console.log(error);
            reply('Somthing went wrong');
          } else {
            if (!user.member) {
              customerMailConfig.to = _envVariables2.default.email.user;
              customerMailConfig.subject = 'Account Activation Requested';
              transporter.sendMail(customerMailConfig, function (error, info) {
                if (error) {
                  console.log(error);
                  reply('Somthing went wrong');
                }
              });
            }
            reply({
              'id_token': (0, _createUserToken2.default)(user),
              'id': user.id,
              'firstName': user.firstName,
              'lastName': user.lastName,
              'accountActivated': user.accountActivated,
              'member': user.member,
              'roleFlags': (0, _userFunctions.getUserRoleFlags)(user),
              'subscriber': user.subscriber,
              'tourneyAdmin': user.tourneyAdmin,
              'eventAdmin': user.eventAdmin,
              'newsContributor': user.newsContributor,
              'venueAdmin': user.venueAdmin,
              'clubAdmin': user.clubAdmin,
              'systemAdmin': user.systemAdmin
            }).code(201);
          }
        });
      }).catch(function (response) {
        throw _boom2.default.badRequest(response);
      });
    });
  },
  changePassword: function changePassword(request, reply) {
    getUserModel({
      'id': request.params.id
    }).then(function (user) {
      // Send forgot password e-mail
      var passwordUpdatedConfig = {
        'from': _envVariables2.default.email.user,
        'to': request.payload.username,
        'subject': 'Battle-Comm: Password Updated',
        'html': (0, _passwordUpdated2.default)(),
        'service': 'Gmail',
        'auth': {
          'user': _envVariables2.default.email.user,
          'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
        }
      };

      transporter.sendMail(passwordUpdatedConfig, function (error, info) {
        if (error) {
          console.log(error);
          reply('Somthing went wrong');
        } else {
          (0, _userFunctions.hashPassword)(request.payload.newPassword, function (err, hash) {
            user.updateAttributes({
              'password': hash
            }).then(function (user) {
              reply(user).code(200);
            });
          });
        }
      });
    });
  },
  resetPassword: function resetPassword(request, reply) {
    var token = (0, _createResetToken2.default)(request.pre.user.email);

    // Send forgot password e-mail
    var forgotPasswordConfig = {
      'from': _envVariables2.default.email.user,
      'to': request.pre.user.email,
      'subject': 'Battle-Comm: Reset Password',
      'html': (0, _forgotPassword2.default)({
        token: token
      }),
      'service': 'Gmail',
      'auth': {
        'user': _envVariables2.default.email.user,
        'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
      }
    };

    transporter.sendMail(forgotPasswordConfig, function (error, info) {
      if (error) {
        console.log(error);
        reply('Something went wrong');
      } else {
        reply({
          'email': request.pre.user.email
        }).code(200);
      }
    });
  },
  verifyResetToken: function verifyResetToken(request, reply) {
    var tokenResponse = (0, _verifyResetToken3.default)(request.params.token);
    console.log(tokenResponse);
    if (tokenResponse) {
      reply(tokenResponse).code(200);
    } else {
      reply(_boom2.default.badRequest('Invalid token'));
    }
  },
  setNewPassword: function setNewPassword(request, reply) {
    _models2.default.User.find({
      'where': {
        'email': request.payload.email
      }
    }).then(function (user) {
      var tokenResponse = (0, _verifyResetToken3.default)(request.params.token);
      if (tokenResponse) {
        // Send forgot password e-mail
        var passwordUpdatedConfig = {
          'from': _envVariables2.default.email.user,
          'to': request.payload.email,
          'subject': 'Battle-Comm: Password Updated',
          'html': (0, _passwordUpdated2.default)(),
          'service': 'Gmail',
          'auth': {
            'user': _envVariables2.default.email.user,
            'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
          }
        };

        transporter.sendMail(passwordUpdatedConfig, function (error, info) {
          if (error) {
            console.log(error);
            reply('Somthing went wrong');
          } else {
            (0, _userFunctions.hashPassword)(request.payload.password, function (err, hash) {
              user.updateAttributes({
                'password': hash
              }).then(function (user) {
                getUserModel({
                  'id': user.id
                }).then(function (user) {
                  reply(user).code(200);
                });
              });
            });
          }
        });
      } else {
        reply(_boom2.default.badRequest('Invalid token'));
      }
    });
  },
  updatePartial: function updatePartial(request, reply) {
    _models2.default.User.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (user) {
      if (user) {
        var sendRPEmail = void 0,
            sendActivationEmail = void 0;
        if (request.payload.rewardPoints && request.payload.rewardPoints !== user.rewardPoints) {
          sendRPEmail = true;
        }
        if (!user.accountActivated && request.payload.accountActivated) {
          sendActivationEmail = true;
        }
        user.updateAttributes({
          // 'email': request.payload.email,
          // 'password': request.payload.password,
          'firstName': request.payload.firstName,
          'lastName': request.payload.lastName,
          'tourneyAdmin': request.payload.tourneyAdmin,
          'member': request.payload.member,
          'subscriber': request.payload.subscriber,
          'eventAdmin': request.payload.eventAdmin,
          'newsContributor': request.payload.NewsContributor,
          'venueAdmin': request.payload.venueAdmin,
          'clubAdmin': request.payload.clubAdmin,
          'systemAdmin': request.payload.systemAdmin,
          'username': request.payload.username,
          'club': request.payload.club,
          'mainPhone': request.payload.mainPhone,
          'mobilePhone': request.payload.mobilePhone,
          'streetAddress': request.payload.streetAddress,
          'aptSuite': request.payload.aptSuite,
          'city': request.payload.city,
          'state': request.payload.state,
          'zip': request.payload.zip,
          'dob': request.payload.dob,
          'bio': request.payload.bio,
          'facebook': request.payload.facebook,
          'twitter': request.payload.twitter,
          'instagram': request.payload.instagram,
          'googlePlus': request.payload.googlePlus,
          'youtube': request.payload.youtube,
          'twitch': request.payload.twitch,
          'website': request.payload.website,
          'rewardPoints': request.payload.rewardPoints,
          'visibility': request.payload.visibility,
          'shareContact': request.payload.shareContact,
          'shareName': request.payload.shareName,
          'shareStatus': request.payload.shareStatus,
          'newsletter': request.payload.newsletter,
          'marketing': request.payload.marketing,
          'sms': request.payload.sms,
          'allowPlay': request.payload.allowPlay,
          'totalWins': request.payload.totalWins,
          'totalLoss': request.payload.totalLoss,
          'totalDraw': request.payload.totalDraw,
          'totalPoints': request.payload.totalPoints,
          'eloRanking': request.payload.eloRanking,
          'accountActivated': request.payload.accountActivated,
          'accountBlocked': request.payload.accountBlocked
        }).then(function (user) {
          user = user.get({ plain: true });
          if (sendRPEmail) {
            var rpMailConfig = {
              'from': _envVariables2.default.email.user,
              'to': user.email,
              'subject': 'Reward Point Update: New Total of ' + user.rewardPoints,
              'html': (0, _rpUpdate2.default)(user),
              'service': 'Gmail',
              'auth': {
                'user': _envVariables2.default.email.user,
                'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
              }
            };

            transporter.sendMail(rpMailConfig, function (error, info) {
              if (error) {
                console.log(error);
                reply(_boom2.default.badRequest('Reward Point Email Failed.'));
              }
            });
          }
          if (sendActivationEmail) {
            var activationMailConfig = {
              'from': _envVariables2.default.email.user,
              'to': user.email,
              'subject': 'Battle-Comm: Account Activated',
              'html': buildAccountActivatedEmail(user),
              'service': 'Gmail',
              'auth': {
                'user': _envVariables2.default.email.user,
                'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
              }
            };

            transporter.sendMail(activationMailConfig, function (error, info) {
              if (error) {
                console.log(error);
                reply(_boom2.default.badRequest('Account Activation Email Failed.'));
              }
            });
          }
          getUserModel({
            'id': user.id
          }).then(function (user) {
            reply(user).code(200);
          });
        });
      } else {
        reply().code(404);
      }
    }).catch(function (err) {
      console.log(err);
    });
  },
  updateRole: function updateRole(request, reply) {
    var userConfig = {};
    _roleConfig2.default.forEach(function (role) {
      if (role.name !== 'public') {
        userConfig[role.name] = false;
      }
    });
    userConfig[request.payload.role] = true;
    _models2.default.User.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (user) {
      if (user) {
        user.updateAttributes(userConfig).then(function (user) {
          getUserModel({
            'id': user.id
          }).then(function (user) {
            reply(user).code(200);
          });
        });
      } else {
        reply().code(404);
      }
    }).catch(function (err) {
      console.log(err);
    });
  },
  updateRP: function updateRP(request, reply) {
    _models2.default.User.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (user) {
      if (user) {
        user[request.payload.direction]({
          'rewardPoints': request.payload.rewardPoints
        }).then(function (user) {
          getUserModel({
            'id': user.id
          }).then(function (user) {
            user = user.get({ 'plain': true });

            var basicUser = {
              'id': user.id,
              'username': user.username,
              'firstName': user.firstName,
              'lastName': user.lastName,
              'rewardPoints': user.rewardPoints
            };

            var rpMailConfig = {
              'from': _envVariables2.default.email.user,
              'to': user.email,
              'subject': 'Reward Point Update: New Total of ' + user.rewardPoints,
              'html': (0, _rpUpdate2.default)(user),
              'service': 'Gmail',
              'auth': {
                'user': _envVariables2.default.email.user,
                'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
              }
            };

            transporter.sendMail(rpMailConfig, function (error, info) {
              if (error) {
                console.log(error);
                reply(_boom2.default.badRequest('Reward Point Email Failed.'));
              }

              reply(basicUser).code(200);
            });
          });
        });
      } else {
        reply().code(404);
      }
    }).catch(function (err) {
      console.log(err);
    });
  },
  // delete: (request, reply) => {
  //     models.UserLogin.destroy({
  //             'where': {
  //                 'id': request.params.id
  //             }
  //         })
  //         .then((response) => {
  //             if (response) {
  //                 reply().code(200);
  //             }
  //             else {
  //                 reply().code(404);
  //             }
  //         });
  // },
  'search': function search(request, reply) {
    var searchByConfig = void 0;
    var pageSize = parseInt(request.payload.pageSize, 10) || 20;
    var searchQuery = request.payload.searchQuery || '';
    var offset = (request.payload.pageNumber - 1) * pageSize;
    var orderBy = request.payload.orderBy ? request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC'] : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? _defineProperty({}, request.payload.searchBy, {
        '$iLike': '%' + searchQuery + '%'
      }) : {
        '$or': [{
          'username': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'email': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'lastName': {
            '$iLike': '%' + searchQuery + '%'
          }
        }]
      };
    } else {
      searchByConfig = {};
    }
    _models2.default.User.findAndCountAll({
      'where': searchByConfig,
      'order': orderBy ? [orderBy] : [],
      'offset': offset,
      'limit': request.payload.pageSize,
      'include': [{
        'model': _models2.default.File
      }, {
        'model': _models2.default.UserPhoto
      }]
    }).then(function (response) {
      var count = response.count;
      var results = response.rows;
      var totalPages = Math.ceil(count === 0 ? 1 : count / pageSize);

      reply({
        'pagination': {
          'pageNumber': request.payload.pageNumber,
          'pageSize': pageSize,
          'totalPages': totalPages,
          'totalResults': count
        },
        'results': results
      }).code(200);
    });
  },
  'searchSuggestions': function searchSuggestions(request, reply) {
    _models2.default.User.findAll({
      'where': {
        '$or': [{
          'firstName': {
            '$iLike': '%' + request.payload.searchQuery + '%'
          }
        }, {
          'lastName': {
            '$iLike': '%' + request.payload.searchQuery + '%'
          }
        }, {
          'username': {
            '$iLike': '%' + request.payload.searchQuery + '%'
          }
        }]
      },
      'attributes': ['id', 'firstName', 'lastName', 'username', 'rewardPoints'],
      'limit': request.payload.maxResults
    }).then(function (results) {
      reply({
        'config': {
          'maxResults': request.payload.maxResults
        },
        'results': results
      }).code(200);
    });
  }
};

exports.default = users;