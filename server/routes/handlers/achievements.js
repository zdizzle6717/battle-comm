'use strict';

import models from '../../models';

// Achievement Route Configs
let achievements = {
    get: (request, reply) => {
        models.Achievement.find({
                'where': {
                    'id': request.params.id
                },
                'include': [{
                        'model': models.File
                    },
                    {
                        'model': models.User,
                        'attributes': ['id', 'username']
                    }
                ]
            })
            .then((response) => {
                if (response) {
                    reply(response).code(200);
                } else {
                    reply().code(404);
                }

            });
    },
    getAll: (request, reply) => {
        models.Achievement.findAll({
                'include': [{
                    'model': models.File
                }],
                'order': [
                    ['priority', 'DESC']
                ]
            })
            .then((response) => {
                reply(response).code(200);
            });
    },
    create: (request, reply) => {
        models.Achievement.create({
                'title': request.payload.title,
                'category': request.payload.category,
                'description': request.payload.description,
                'priority': request.payload.priority || 100,
                'rpValue': request.payload.rpValue || 0
            })
            .then((response) => {
                reply(response).code(200);
            });
    },
    update: (request, reply) => {
        models.Achievement.find({
                'where': {
                    'id': request.params.id
                }
            })
            .then((achievement) => {
                if (achievement) {
                    achievement.updateAttributes({
                        'title': request.payload.title,
                        'category': request.payload.category,
                        'description': request.payload.description,
                        'priority': request.payload.priority,
                        'rpValue': request.payload.rpValue
                    }).then((response) => {
                        reply(response).code(200);
                    });
                } else {
                    reply().code(404);
                }
            });
    },
    'search': (request, reply) => {
        let searchByConfig;
        let pageSize = parseInt(request.payload.pageSize, 10) || 20;
        let searchQuery = request.payload.searchQuery || '';
        let offset = (request.payload.pageNumber - 1) * pageSize;
        let orderBy = request.payload.orderBy ? (request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC']) : ['priority', 'DESC'];
        if (searchQuery) {
            searchByConfig = request.payload.searchBy ? {
                [request.payload.searchBy]: {
                    '$iLike': '%' + searchQuery + '%'
                }
            } : {
                '$or': [{
                        'title': {
                            '$iLike': '%' + searchQuery + '%'
                        }
                    },
                    {
                        'description': {
                            '$iLike': '%' + searchQuery + '%'
                        }
                    }
                ]
            };
        } else {
            searchByConfig = {};
        }
        models.Achievement.findAndCountAll({
            'where': searchByConfig,
            'order': orderBy ? [orderBy] : [],
            'offset': offset,
            'limit': pageSize,
            'include': [{
                'model': models.File
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
    },
    delete: (request, reply) => {
        models.Achievement.destroy({
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


export default achievements;
