'use strict';

const jwt = require('jsonwebtoken');
const env = require('../config/environmentVariables');

function verifyResetToken(token) {
	try {
		var decoded = jwt.verify(token, env.secret);
	} catch (error) {
		return false;
	}
	if (!decoded) {
		return false;
	} else {
		return decoded;
	}
}

module.exports = verifyResetToken;
