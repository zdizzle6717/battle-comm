'use strict';

require('babel-core/register');

const Hapi = require('hapi');
const Inert = require('inert');
const Vision = require('vision');
const HapiSwagger = require('hapi-swagger');
let models = require('./models');
let env = require('./config/environmentVariables.js')

// Create Server
const server = new Hapi.Server();
server.connection({
    port: env.port,
    routes: {
        cors: {
            origin: [env.cors.origin]
        }
    }
});

const options = {
    info: {
        'title': 'Hapi Stack API Documentation',
        'version': '1.0.0',
    },
    basePath: '/api/',
    pathPrefixSize: 2,
    tags: [{
        'name': 'products'
    }, {
        'name': 'test'
    }],
    enableDocumentation: env.enableDocumentation
};

// Register Swagger Plugin ( Use for documentation and testing purpose )
server.register([
        Inert,
        Vision, {
            register: HapiSwagger,
            options: options
        }
    ], {
        routes: {
            prefix: '/api'
        }
    },
    function(err) {
        if (err) {
            server.log(['error'], 'hapi-swagger load error: ' + err);
        } else {
            server.log(['start'], 'hapi-swagger interface loaded');
        }
    });

// Routes
server.route(require('./routes'));

models.sequelize.sync().then(function() {
    server.start((err) => {
        if (err) {
            throw err;
        }
        console.log('Server running at:', server.info.uri);
    });
});
