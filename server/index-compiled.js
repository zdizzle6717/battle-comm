'use strict';

var _hapi = require('hapi');

var _hapi2 = _interopRequireDefault(_hapi);

var _cluster = require('cluster');

var _cluster2 = _interopRequireDefault(_cluster);

var _os = require('os');

var _os2 = _interopRequireDefault(_os);

var _inert = require('inert');

var _inert2 = _interopRequireDefault(_inert);

var _vision = require('vision');

var _vision2 = _interopRequireDefault(_vision);

var _fs = require('fs');

var _fs2 = _interopRequireDefault(_fs);

var _hapiSwagger = require('hapi-swagger');

var _hapiSwagger2 = _interopRequireDefault(_hapiSwagger);

var _hapiAuthJwt = require('hapi-auth-jwt2');

var _hapiAuthJwt2 = _interopRequireDefault(_hapiAuthJwt);

var _models = require('./models');

var _models2 = _interopRequireDefault(_models);

var _envVariables = require('../envVariables');

var _envVariables2 = _interopRequireDefault(_envVariables);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

require('babel-core/register');

var routes = require('./routes');

// Create Server
var server = new _hapi2.default.Server();
var apiConfig = {
  'port': _envVariables2.default.apiPort,
  'routes': {
    'cors': {
      'origin': _envVariables2.default.cors.origin
    }
  },
  'labels': ['api']
};
if (_envVariables2.default.name === 'production') {
  apiConfig.tls = {
    'key': _fs2.default.readFileSync('ssl/www.battle-comm.net.key'),
    'cert': _fs2.default.readFileSync('ssl/www.battle-comm.net.chained.crt')
  };
}
server.connection(apiConfig);
var chatConfig = {
  'port': _envVariables2.default.chatPort,
  'routes': {
    'cors': {
      'origin': _envVariables2.default.cors.origin
    }
  },
  'labels': ['chat']
};
if (_envVariables2.default.name === 'production') {
  chatConfig.tls = {
    'key': _fs2.default.readFileSync('ssl/www.battle-comm.net.key'),
    'cert': _fs2.default.readFileSync('ssl/www.battle-comm.net.chained.crt')
  };
}
server.connection(chatConfig);

var validateUser = function validateUser(decodedToken, request, callback) {
  // Investigate ways to improve validation and allow access based on specific request and related user details
  var error = void 0;
  var credentials = {
    'id': decodedToken.id,
    'username': decodedToken.username,
    'scope': decodedToken.scope
  };

  return callback(error, true, credentials);
};

// Socket.io
// Register Socket.io chat Config
server.register(require('./chat'), function (err) {
  if (err) {
    throw err;
  }
});

// Documentation (Swagger) Config
var documentationOptions = {
  'info': {
    'title': 'Battle-Comm API Documentation',
    'version': _envVariables2.default.version
  },
  'basePath': '/api/',
  'pathPrefixSize': 2,
  'documentationPage': _envVariables2.default.name === 'production' ? false : true
};

// Register Swagger Plugin ( Use for documentation and testing purpose )
server.register([_inert2.default, _vision2.default, {
  'register': _hapiSwagger2.default,
  'options': documentationOptions
}], {
  'routes': {
    'prefix': '/api'
  }
}, function (err) {
  if (err) {
    server.log(['error'], 'hapi-swagger load error: ' + err);
  } else {
    server.log(['start'], 'hapi-swagger interface loaded');
  }
});

// Register hapi-auth-jwt Plugin
server.register(_hapiAuthJwt2.default, function (err) {
  if (err) {
    console.log(err);
    return;
  }
  server.auth.strategy('jsonWebToken', 'jwt', {
    'key': _envVariables2.default.secret,
    'verifyOptions': {
      'algorithms': ['HS256']
    },
    'validateFunc': validateUser
  });
});

// Api Routes
for (var route in routes) {
  server.select('api').route(routes[route]);
}

if (false /* cluster.isMaster */) {
    var numWorkers = _os2.default.cpus().length;

    console.log('Master cluster setting up ' + numWorkers + ' workers...');

    for (var i = 0; i < numWorkers; i++) {
      _cluster2.default.fork();
    }

    _cluster2.default.on('online', function (worker) {
      console.log('Worker ' + worker.process.pid + ' is online');
    });

    _cluster2.default.on('exit', function (worker, code, signal) {
      console.log('Worker ' + worker.process.pid + ' died with code: ' + code + ', and signal: ' + signal);
      console.log('Starting a new worker');
      _cluster2.default.fork();
    });
  } else {
  _models2.default.sequelize.sync().then(function () {
    server.start(function (err) {
      if (err) {
        throw err;
      }
      console.log('API server running at:', server.select('api').info.uri, 'with process id', process.pid);
      console.log('Chat server running at:', server.select('chat').info.uri, 'with process id', process.pid);
    });
  });
}
