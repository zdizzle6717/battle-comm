'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

var _boom = require('boom');

var _boom2 = _interopRequireDefault(_boom);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Product Route Configs
var gameSystemRankings = {
    createOrUpdate: function createOrUpdate(request, reply) {
        _models2.default.GameSystemRanking.findOrCreate({
            'where': {
                '$and': [{
                    'GameSystemId': request.payload.GameSystemId
                }, {
                    'UserId': request.payload.UserId
                }]
            },
            'defaults': {
                'UserId': request.payload.UserId,
                'GameSystemId': request.payload.GameSystemId,
                'totalWins': request.payload.totalWins,
                'totalDraws': request.payload.totalDraws,
                'totalLosses': request.payload.totalLosses
            }
        }).spread(function (gameSystemRanking, created) {
            if (created) {
                _models2.default.FactionRanking.findOrCreate({
                    'where': {
                        '$and': [{
                            'FactionId': request.payload.FactionId
                        }, {
                            'GameSystemRankingId': gameSystemRanking.id
                        }]
                    },
                    'defaults': {
                        'FactionId': request.payload.FactionId,
                        'GameSystemRankingId': gameSystemRanking.id,
                        'totalWins': request.payload.totalWins,
                        'totalDraws': request.payload.totalDraws,
                        'totalLosses': request.payload.totalLosses
                    }
                }).spread(function (factionRanking, created) {
                    if (created) {
                        reply(factionRanking).code(200);
                    } else {
                        factionRanking.increment({
                            'totalWins': request.payload.totalWins,
                            'totalDraws': request.payload.totalDraws,
                            'totalLosses': request.payload.totalLosses
                        }).then(function (response) {
                            reply(response).code(200);
                        });
                    }
                });
            } else {
                gameSystemRanking.increment({
                    'totalWins': request.payload.totalWins,
                    'totalDraws': request.payload.totalDraws,
                    'totalLosses': request.payload.totalLosses
                }).then(function (gameSystemRanking) {
                    _models2.default.FactionRanking.findOrCreate({
                        'where': {
                            '$and': [{
                                'FactionId': request.payload.FactionId
                            }, {
                                'GameSystemRankingId': gameSystemRanking.id
                            }]
                        },
                        'defaults': {
                            'FactionId': request.payload.FactionId,
                            'GameSystemRankingId': gameSystemRanking.id,
                            'totalWins': request.payload.totalWins,
                            'totalDraws': request.payload.totalDraws,
                            'totalLosses': request.payload.totalLosses
                        }
                    }).spread(function (factionRanking, created) {
                        if (created) {
                            reply(factionRanking).code(200);
                        } else {
                            factionRanking.increment({
                                'totalWins': request.payload.totalWins,
                                'totalDraws': request.payload.totalDraws,
                                'totalLosses': request.payload.totalLosses
                            }).then(function (response) {
                                reply(response).code(200);
                            });
                        }
                    });
                });
            }
        }).catch(function (err) {
            throw _boom2.default.badRequest(err);
        });
    },
    search: function search(request, reply) {
        var pageSize = request.payload.pageSize || 20;
        var offset = (request.payload.pageNumber - 1) * pageSize;
        var searchConfig = {
            '$and': [{
                'GameSystemId': request.params.id
            }, {
                'UserId': {
                    '$gt': 0
                }
            }]
        };

        _models2.default.GameSystemRanking.findAll({
            'where': searchConfig,
            'include': [{
                'model': _models2.default.User,
                'attributes': ['username', 'id']
            }, {
                'model': _models2.default.GameSystem,
                'attributes': ['name']
            }],
            'offset': offset,
            'limit': request.payload.pageSize,
            'order': [['totalWins', 'DESC']]
        }).then(function (response) {
            var results = response;

            _models2.default.GameSystemRanking.findAll({
                'where': searchConfig
            }).then(function (rankings) {
                var count = rankings.length;
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

exports.default = gameSystemRankings;