'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Product Route Configs
var factionRankings = {
    search: function search(request, reply) {
        var pageSize = request.payload.pageSize || 20;
        var offset = (request.payload.pageNumber - 1) * pageSize;
        var searchConfig = {
            'FactionId': request.params.id
        };

        _models2.default.FactionRanking.findAll({
            'where': searchConfig,
            'include': [{
                'model': _models2.default.Faction,
                'attributes': ['name']
            }, {
                'model': _models2.default.GameSystemRanking,
                'attributes': ['UserId'],
                'include': [{
                    'model': _models2.default.GameSystem,
                    'attributes': ['name', 'id']
                }, {
                    'model': _models2.default.User,
                    'attributes': ['username']
                }]
            }],
            'offset': offset,
            'limit': request.payload.pageSize,
            'order': [['totalWins', 'DESC']]
        }).then(function (response) {
            var results = response;

            _models2.default.FactionRanking.findAll({
                'where': searchConfig
            }).then(function (rankings) {
                var count = rankings.count;
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
        });
    }
};

exports.default = factionRankings;