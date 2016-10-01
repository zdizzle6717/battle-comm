'use strict';

require('babel-core/register');

const Hapi = require('hapi');
const Boom = require('boom');
const Inert = require('inert');
const Vision = require('vision');
const HapiSwagger = require('hapi-swagger');
const hapiUploader = require('hapi-uploader');
const HapiAuthJwt = require('hapi-auth-jwt');
let models = require('./models');
let env = require('./config/environmentVariables');
let routes = require('./routes');

// Create Server
const server = new Hapi.Server();
server.connection({
    port: env.port,
    routes: {
        cors: {
            origin: env.cors.origin
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
    documentationPage: env.swagger.documentationPage
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

server.register({
    register: hapiUploader,
    options: {
        upload: {
            path: './'
        }
    }
}, (err) => {
    if (err) {
        console.log('Failed loading plugin', err);
        process.exit(1)
    }
});

// Register hapi-auth-jwt Plugin
server.register(HapiAuthJwt, (err) => {
	server.auth.strategy('jsonWebToken', 'jwt', {
		key: env.secret,
		verifyOptions: {
			algorithms: ['HS256']
		}
	});
});

// Routes
for (var route in routes) {
    server.route(routes[route]);
}


models.sequelize.sync().then(function() {
    server.start((err) => {
        if (err) {
            throw err;
        }
        console.log('Server running at:', server.info.uri);
    });
});
