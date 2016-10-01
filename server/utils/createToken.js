'use strict';

const jwt = require('jsonwebtoken');
const env = require('../config/environmentVariables');

function createToken(user) {
  let scopes = [];
  if (user.subscriber) {
    scopes.push('subscriber');
  }
  if (user.tourneyAdmin) {
    scopes.push('tourneyAdmin');
  }
  if (user.eventAdmin) {
    scopes.push('eventAdmin');
  }
  if (user.newsContributor) {
    scopes.push('newsContributor');
  }
  if (user.venueAdmin) {
    scopes.push('venueAdmin');
  }
  if (user.clubAdmin) {
    scopes.push('clubAdmin');
  }
  if (user.systemAdmin) {
    scopes.push('systemAdmin');
  }
  // Sign the JWT
  return jwt.sign({ id: user.id, username: user.username, scope: scopes }, env.secret, { algorithm: 'HS256', expiresIn: "1h" } );
}

module.exports = createToken;
