'use strict';

import models from '../../models';

// Product Route Configs
let factionRankings = {
  search: (request, reply) => {
    let pageSize = request.payload.pageSize || 20;
    let offset = (request.payload.pageNumber - 1) * pageSize;
    models.FactionRanking.findAndCountAll({
        'where': {
          'FactionId': request.payload.FactionId
        },
        'include': [{
            'model': models.Faction,
            'attributes': ['name']
          },
          {
            'model': models.GameSystemRanking,
            'attributes': ['UserId'],
            'include': [{
                'model': models.GameSystem,
                'attributes': ['name', 'id']
              },
              {
                'model': models.User,
                'attributes': ['username']
              }
            ]
          }
        ],
				'offset': offset,
        'order': [
          ['totalWins', 'DESC']
        ]
      })
      .then((response) => {
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

export default factionRankings;
