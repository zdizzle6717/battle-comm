'use strict';

import models from '../../models';

// Product Route Configs
let userFriends = {
  create: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.payload.UserId
        }
      })
      .then((user1) => {
        models.User.find({
            'where': {
              'id': request.payload.InviteeId
            }
          })
          .then((user2) => {
            user1.addFriend(user2).then((user1Response) => {
              user2.addFriend(user1).then((user2Response) => {
                reply(user1Response).code(200);
              });
            });
          })
          .catch((response) => {
            reply(response).code(404);
          });
      })
      .catch((response) => {
        reply(response).code(404);
      });
  },
  remove: (request, reply) => {
    models.User.find({
        'where': {
          'id': request.params.UserId
        }
      })
      .then((user1) => {
        models.User.find({
            'where': {
              'id': request.params.InviteeId
            }
          })
          .then((user2) => {
            user1.removeFriend(user2).then((user1Response) => {
              user2.removeFriend(user1).then((user2Response) => {
                reply(user1Response).code(200);
              });
            });
          })
          .catch((response) => {
            reply(response).code(404);
          });
      })
      .catch((response) => {
        reply(response).code(404);
      });
  }
};


export default userFriends;
