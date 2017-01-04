'use strict';

require('babel-core/register');

const Hapi = require('hapi');
const Boom = require('boom');
const Inert = require('inert');
const Vision = require('vision');
const fs = require('fs');
const HapiSwagger = require('hapi-swagger');
const hapiUploader = require('hapi-uploader');
const HapiAuthJwt = require('hapi-auth-jwt');

let models = require('./models');
let env = require('./config/environmentVariables');
let routes = require('./routes');

// Create Server
var server = new Hapi.Server();
let apiConfig = {
    port: env.port.api,
    routes: {
        cors: {
            origin: env.cors.origin
        }
    },
	labels: ['api']
};
if (env.name === 'production') {
	apiConfig.tls.key = fs.readFileSync('ssl/www.battle-comm.net.key');
	apiConfig.tls.cert = fs.readFileSync('ssl/www.battle-comm.net.chained.crt');
}
apiConfig.port =
server.connection(apiConfig);
let chatConfig = {
    port: env.port.chat,
    routes: {
        cors: {
            origin: env.cors.origin
        }
    },
	labels: ['chat']
};
if (env.name === 'production') {
	chatConfig.tls.key = fs.readFileSync('ssl/www.battle-comm.net.key');
	chatConfig.tls.cert = fs.readFileSync('ssl/www.battle-comm.net.chained.crt');
}
server.connection(chatConfig);


// Socket.io
// Register Socket.io chat Config
server.register(require('./chat'), function(err) {
	if (err) {
		throw err;
	}

});


// Documentation (Swagger) Config
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
    }
);

// server.register({
//     register: hapiUploader,
//     options: {
//         upload: {
//             path: './'
//         }
//     }
// }, (err) => {
//     if (err) {
//         console.log('Failed loading plugin', err);
//         process.exit(1)
//     }
// });

// Register hapi-auth-jwt Plugin
server.register(HapiAuthJwt, (err) => {
	server.auth.strategy('jsonWebToken', 'jwt', {
		key: env.secret,
		verifyOptions: {
			algorithms: ['HS256']
		}
	});
});

// Api Routes
for (var route in routes) {
    server.select('api').route(routes[route]);
}

models.sequelize.sync().then(function() {
    server.start((err) => {
        if (err) {
            throw err;
        }
        console.log('API server running at:', server.select('api').info.uri);
        console.log('Chat server running at:', server.select('chat').info.uri);
    });
});
