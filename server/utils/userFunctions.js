'use strict';

import Boom from 'boom';
import bcrypt from 'bcrypt';
import models from '../models';

const verifyUniqueUser = (req, res) => {
  models.User.find({
    'where': {
      '$or': [{
        'email': req.payload.email
      }, {
        'username': req.payload.username
      }]
    }
  }).then((user) => {
    if (user) {
      if (user.username === req.payload.username) {
        res(Boom.badRequest('Username taken'));
      }
      if (user.email === req.payload.email) {
        res(Boom.badRequest('Email taken'));
      }
    }
    res(req.payload);
  }).catch((response) => {
    console.log(response);
  });
};

const verifyCredentials = (req, res) => {
  const password = req.payload.password;

  models.User.find({
    'where': {
      '$or': [{
        'email': req.payload.username
      }, {
        'username': req.payload.username
      }]
    }
  }).then((user) => {
    if (user) {
      bcrypt.compare(password, user.password, (err, isValid) => {
        if (isValid) {
          res(user);
        } else {
          res(Boom.badRequest('Incorrect password!'));
        }
      });
    } else {
      res(Boom.badRequest('Incorrect username or email!'));
    }
  }).catch((response) => {
    console.log(response);
  });
};

const verifyUserExists = (req, res) => {
  models.User.find({
    'where': {
      'email': req.payload.email
    }
  }).then((user) => {
    if (user) {
      res(user);
    } else {
      res(Boom.badRequest('User not found.'));
    }
  }).catch((response) => {
    console.log(response);
  });
};

const hashPassword = (password, cb) => {
  bcrypt.genSalt(10, (err, salt) => {
    bcrypt.hash(password, salt, (error, hash) => {
      return cb(err, hash);
    });
  });
};

export {
  verifyUniqueUser,
  verifyCredentials,
  verifyUserExists,
  hashPassword
};
