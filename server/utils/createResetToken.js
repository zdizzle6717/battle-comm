'use strict';

const jwt = require('jsonwebtoken');
const env = require('../config/environmentVariables');

function createResetToken(email) {
  // Sign the JWT
  return jwt.sign({ email: email }, env.secret, { algorithm: 'HS256', expiresIn: "1d" } );
}

module.exports = createResetToken;
