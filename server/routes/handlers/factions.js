'use strict';

import models from '../../models';

// Product Route Configs
let factions = {
  create: (request, reply) => {
    models.Faction.create({
        'GameSystemId': request.payload.GameSystemId,
        'name': request.payload.name,
      })
      .then((response) => {
        reply(response).code(200);
      });
  },
  update: (request, reply) => {
    models.Faction.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((faction) => {
        if (faction) {
          faction.updateAttributes({
            'name': request.payload.name,
          }).then((response) => {
            reply(response).code(200);
          });
        } else {
          reply().code(404);
        }
      });
  },
  delete: (request, reply) => {
    models.Faction.destroy({
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

export default factions;
