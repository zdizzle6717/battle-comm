'use strict';

require('babel-core/register');

import Hapi from 'hapi';
import cluster from 'cluster';
import os from 'os';
import Boom from 'boom';
import Inert from 'inert';
import Vision from 'vision';
import fs from 'fs';
import HapiSwagger from 'hapi-swagger';
import hapiUploader from 'hapi-uploader';
import HapiAuthJwt from 'hapi-auth-jwt2';
import models from './models';
import env from '../envVariables';

let routes = require('./routes');

// Create Server
let server = new Hapi.Server();
let apiConfig = {
    port: env.apiPort,
    routes: {
        cors: {
            origin: env.cors.origin
        }
    },
	labels: ['api']
};
if (env.name === 'production') {
	apiConfig.tls = {
		'key': fs.readFileSync('ssl/www.battle-comm.net.key'),
		'cert': fs.readFileSync('ssl/www.battle-comm.net.chained.crt')
	}
}
server.connection(apiConfig);
let chatConfig = {
    port: env.chatPort,
    routes: {
        cors: {
            origin: env.cors.origin
        }
    },
	labels: ['chat']
};
if (env.name === 'production') {
	chatConfig.tls = {
		'key': fs.readFileSync('ssl/www.battle-comm.net.key'),
		'cert': fs.readFileSync('ssl/www.battle-comm.net.chained.crt')
	}
}
server.connection(chatConfig);

const validateUser = (decodedToken, request, callback) => {
	// Investigate ways to improve validation and allow access based on specific request and related user details
	let error;
	let credentials = {
		'id': decodedToken.id,
		'username': decodedToken.username,
		'scope': decodedToken.scope
	};

	return callback(error, true, credentials);
};

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

// Register hapi-auth-jwt Plugin
server.register(HapiAuthJwt, (err) => {
	server.auth.strategy('jsonWebToken', 'jwt', {
		key: env.secret,
		verifyOptions: {
			algorithms: ['HS256']
		},
		validateFunc: validateUser
	});
});

// Api Routes
for (let route in routes) {
    server.select('api').route(routes[route]);
}

if (false) {
  let numWorkers = os.cpus().length;

  console.log('Master cluster setting up ' + numWorkers + ' workers...');

  for (let i = 0; i < numWorkers; i++) {
    cluster.fork();
  }

  cluster.on('online', function(worker) {
    console.log('Worker ' + worker.process.pid + ' is online');
  });

  cluster.on('exit', function(worker, code, signal) {
    console.log('Worker ' + worker.process.pid + ' died with code: ' + code + ', and signal: ' + signal);
    console.log('Starting a new worker');
    cluster.fork();
  });
} else {
	models.sequelize.sync().then(function() {
	    server.start((err) => {
	        if (err) {
	            throw err;
	        }
	        console.log('API server running at:', server.select('api').info.uri, 'with process id', process.pid);
	        console.log('Chat server running at:', server.select('chat').info.uri, 'with process id', process.pid);
	    });
	});
}
