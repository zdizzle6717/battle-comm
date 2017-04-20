'use strict';

import env from '../../../envVariables';
import models from '../../models';
import Boom from 'boom';
import nodemailer from 'nodemailer';
import xoauth2 from 'xoauth2';
import buildRPUpdateEmail from '../../email-templates/rpUpdate';
import buildRegistrationEmail from '../../email-templates/buildRegistrationEmail';
import buildForgotPasswordEmail from '../../email-templates/forgotPassword';
import buildPasswordUpdatedEmail from '../../email-templates/passwordUpdated';

import createUserToken from '../../utils/createUserToken';
import createResetToken from '../../utils/createResetToken';
import verifyResetToken from '../../utils/verifyResetToken';
import {hashPassword, getUserRoleFlags} from '../../utils/userFunctions';
import roleConfig from '../../../roleConfig';

let generator = xoauth2.createXOAuth2Generator(env.email.XOAuth2);

// listen for token updates
// consider storying these to a db
generator.on('token', (token) => {});

let transporter = nodemailer.createTransport(({
  'service': 'Gmail',
  'auth': {
    'xoauth2': generator
  }
}));

const getUserModel = (where) => {
	return models.User.find({
			'where': where,
			'attributes': {
				'exclude': ['password']
			},
			'include': [{
					'model': models.UserNotification
				},
				{
					'model': models.UserPhoto
				},
				{
					'model': models.User,
					'as': 'Friends',
					'attributes': ['id', 'firstName', 'lastName', 'username']
				},
				{
					'model': models.GameSystemRanking,
					'include': [{
							'model': models.GameSystem,
							'attributes': ['name']
						},
						{
							'model': models.FactionRanking,
							'include': [{
								'model': models.Faction,
								'attributes': ['name']
							}]
						}
					]
				},
				{
					'model': models.File
				}
			],
		});
};

// Product Route Configs
let users = {
	activateAccount: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((user) => {
        if (user) {
          user.updateAttributes({
						'accountActivated': true
					}).then((user) => {
						reply(user).code(200);
					});
        } else {
          reply().code(404);
        }
      }).catch((err) => {
        console.log(err);
      });
  },
	blockUser: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((user) => {
        if (user) {
          user.updateAttributes({
						'accountBlocked': request.payload.accountBlocked
					}).then((user) => {
						getUserModel({
							'id': user.id
						}).then((user) => {
							reply(user).code(200);
						});
					});
        } else {
          reply().code(404);
        }
      }).catch((err) => {
        console.log(err);
      });
  },
  get: (request, reply) => {
		let where = {};
		if (request.params.id) {
			where = {
				'id': request.params.id
			};
		} else if (request.params.username) {
			where = {
				'username': request.params.username
			};
		}
    getUserModel(where)
      .then((response) => {
        if (response) {
          reply(response).code(200);
        } else {
          reply().code(404);
        }
      });
  },
  getAll: (request, reply) => {
    models.User.findAll({
			'include': [{
				'model': models.File
			}]
		})
      .then((products) => {
        reply(products).code(200);
      });
  },
  create: (request, reply) => {
    hashPassword(request.payload.password, (err, hash) => {
			let userConfig = {
        'email': request.payload.email,
        'firstName': request.payload.firstName,
        'lastName': request.payload.lastName,
        'username': request.payload.username,
        'password': hash,
				'accountActivated': request.payload.role === 'member'
      };
			roleConfig.forEach((role) => {
				if (role.name !== 'public') {
					userConfig[role.name] = false;
				}
			});
			userConfig[request.payload.role] = true;
      models.User.create(userConfig)
        .then((user) => {
					user = user.get({'plain': true});
          // Send confirmation e-mail
          let customerMailConfig = {
            'from': env.email.user,
            'to': user.email,
            'subject': `Welcome to Battle-Comm!`,
            'html': buildRegistrationEmail(request.payload.role, user)
          };

          transporter.sendMail(customerMailConfig, (error, info) => {
            if (error) {
              console.log(error);
              reply('Somthing went wrong');
            } else {
							if (!user.member) {
								customerMailConfig.to = env.email.user;
								customerMailConfig.subject = 'Account Activation Requested';
								transporter.sendMail(customerMailConfig, (error, info) => {
									if (error) {
										console.log(error);
			              reply('Somthing went wrong');
									}
								});
							}
							reply({
                'id_token': createUserToken(user),
                'id': user.id,
                'firstName': user.firstName,
                'lastName': user.lastName,
								'accountActivated': user.accountActivated,
                'member': user.member,
								'roleFlags': getUserRoleFlags(user),
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
        })
        .catch((response) => {
          throw Boom.badRequest(response);
        });
    });
  },
  authenticate: (request, reply) => {
    reply({
			'username': request.pre.user.username,
      'id_token': createUserToken(request.pre.user),
			'roleFlags': getUserRoleFlags(request.pre.user),
      'id': request.pre.user.id,
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
			'UserPhoto': request.pre.user.UserPhoto
    }).code(201);
  },
  changePassword: (request, reply) => {
    getUserModel({
      'id': request.params.id
    }).then((user) => {
      // Send forgot password e-mail
      let passwordUpdatedConfig = {
        'from': env.email.user,
        'to': request.payload.username,
        'subject': `Battle-Comm: Password Updated`,
        'html': buildPasswordUpdatedEmail()
      };

      transporter.sendMail(passwordUpdatedConfig, (error, info) => {
        if (error) {
          console.log(error);
          reply('Somthing went wrong');
        } else {
          hashPassword(request.payload.newPassword, (err, hash) => {
            user.updateAttributes({
              'password': hash
            }).then((user) => {
              reply(user).code(200);
            });
          });
        }
      });
    });
  },
  resetPassword: (request, reply) => {
    let token = createResetToken(request.pre.user.email);

    // Send forgot password e-mail
    let forgotPasswordConfig = {
      'from': env.email.user,
      'to': request.pre.user.email,
      'subject': `Battle-Comm: Reset Password`,
      'html': buildForgotPasswordEmail({
        token
      })
    };

    transporter.sendMail(forgotPasswordConfig, (error, info) => {
      if (error) {
        console.log(error);
        reply('Somthing went wrong');
      } else {
        reply({
					'email': request.pre.user.email
				}).code(200);
      }
    });

  },
  verifyResetToken: (request, reply) => {
    let tokenResponse = verifyResetToken(request.params.token);
    console.log(tokenResponse);
    if (tokenResponse) {
      reply(tokenResponse).code(200);
    } else {
      reply(Boom.badRequest('Invalid token'));
    }
  },
  setNewPassword: (request, reply) => {
    models.User.find({
      'where': {
        'email': request.payload.email
      }
    }).then((user) => {
      let tokenResponse = verifyResetToken(request.params.token);
      if (tokenResponse) {
        // Send forgot password e-mail
        let passwordUpdatedConfig = {
          'from': env.email.user,
          'to': request.payload.email,
          'subject': `Battle-Comm: Password Updated`,
          'html': buildPasswordUpdatedEmail()
        };

        transporter.sendMail(passwordUpdatedConfig, (error, info) => {
          if (error) {
            console.log(error);
            reply('Somthing went wrong');
          } else {
            hashPassword(request.payload.password, (err, hash) => {
              user.updateAttributes({
                'password': hash
              }).then((user) => {
								getUserModel({
									'id': user.id
								}).then((user) => {
									reply(user).code(200);
								});
              });
            });
          }
        });
      } else {
        reply(Boom.badRequest('Invalid token'));
      }

    });
  },
  updatePartial: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((user) => {
        if (user) {
          let sendRPEmail, sendActivationEmail;
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
          }).then((user) => {
						user = user.get({plain: true});
            if (sendRPEmail) {
              let rpMailConfig = {
                'from': env.email.user,
                'to': user.email,
                'subject': `Reward Point Update: New Total of ${user.rewardPoints}`,
                'html': buildRPUpdateEmail(user)
              };

              transporter.sendMail(rpMailConfig, (error, info) => {
                if (error) {
                  console.log(error);
                  reply(Boom.badRequest('Reward Point Email Failed.'));
                }
              });
            }
            if (sendActivationEmail) {
              let activationMailConfig = {
                'from': env.email.user,
                'to': user.email,
                'subject': `Battle-Comm: Account Activated`,
                'html': buildAccountActivatedEmail(user)
              };

              transporter.sendMail(activationMailConfig, (error, info) => {
                if (error) {
                  console.log(error);
                  reply(Boom.badRequest('Account Activation Email Failed.'));
                }
              });
            }
						getUserModel({
							'id': user.id
						}).then((user) => {
							reply(user).code(200);
						});
          });
        } else {
          reply().code(404);
        }
      }).catch((err) => {
        console.log(err);
      });
  },
  updateRole: (request, reply) => {
		let userConfig = {};
		roleConfig.forEach((role) => {
			if (role.name !== 'public') {
				userConfig[role.name] = false;
			}
		});
		userConfig[request.payload.role] = true;
    models.User.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((user) => {
        if (user) {
          user.updateAttributes(userConfig).then((user) => {
						getUserModel({
							'id': user.id
						}).then((user) => {
							reply(user).code(200);
						});
					});
        } else {
          reply().code(404);
        }
      }).catch((err) => {
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
  'search': (request, reply) => {
    let searchByConfig;
    let pageSize = parseInt(request.payload.pageSize, 10) || 20;
    let searchQuery = request.payload.searchQuery || '';
    let offset = (request.payload.pageNumber - 1) * pageSize;
		let orderBy = request.payload.orderBy ? (request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC']) : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? {
        [request.payload.searchBy]: {
          '$iLike': '%' + searchQuery + '%'
        }
      } : {
        '$or': [{
            'username': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'email': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'lastName': {
              '$iLike': '%' + searchQuery + '%'
            }
          }
        ]
      };
    } else {
      searchByConfig = {};
    }
    models.User.findAndCountAll({
      'where': searchByConfig,
			'order': orderBy ? [orderBy] : [],
      'offset': offset,
			'limit': request.payload.pageSize,
			'include': [{
				'model': models.File
			}, {
				'model': models.UserPhoto
			}]
    }).then((response) => {
      let count = response.count;
      let results = response.rows;
      let totalPages = Math.ceil(count === 0 ? 1 : (count / pageSize));

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
  }
};

export default users;
