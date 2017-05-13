'use strict';

module.exports = function (sequelize, DataTypes) {
  var User = sequelize.define('User', {
    'email': {
      'type': DataTypes.STRING,
      'unique': true
    },
    'customerId': {
      'type': DataTypes.STRING,
      'unique': true
    },
    'password': DataTypes.STRING,
    'firstName': DataTypes.STRING,
    'lastName': DataTypes.STRING,
    'member': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'subscriber': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'tourneyAdmin': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'eventAdmin': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'newsContributor': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'venueAdmin': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'clubAdmin': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'systemAdmin': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'username': {
      'type': DataTypes.STRING,
      'unique': true
    },
    'club': DataTypes.INTEGER,
    'mainPhone': DataTypes.STRING,
    'mobilePhone': DataTypes.STRING,
    'streetAddress': DataTypes.STRING,
    'aptSuite': DataTypes.STRING,
    'city': DataTypes.STRING,
    'state': DataTypes.STRING,
    'zip': DataTypes.STRING,
    'dob': DataTypes.DATE,
    'bio': {
      'type': DataTypes.TEXT,
      'default': '...'
    },
    'facebook': DataTypes.STRING,
    'twitter': DataTypes.STRING,
    'instagram': DataTypes.STRING,
    'googlePlus': DataTypes.STRING,
    'youtube': DataTypes.STRING,
    'twitch': DataTypes.STRING,
    'website': DataTypes.STRING,
    'rewardPoints': {
      'type': DataTypes.INTEGER,
      'default': 0
    },
    'visibility': DataTypes.STRING,
    'shareContact': DataTypes.STRING,
    'shareName': DataTypes.STRING,
    'shareStatus': DataTypes.STRING,
    'newsletter': DataTypes.STRING,
    'marketing': DataTypes.STRING,
    'sms': DataTypes.STRING,
    'allowPlay': DataTypes.STRING,
    'eloRanking': {
      'type': DataTypes.INTEGER,
      'defaultValue': 0
    },
    'accountActivated': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'accountBlocked': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    },
    'hasAuthenticatedOnce': {
      'type': DataTypes.BOOLEAN,
      'defaultValue': false
    }
  }, {
    'classMethods': {
      associate: function associate(models) {
        User.hasMany(models.File);
        User.hasMany(models.ProductOrder);
        User.hasMany(models.GameSystemRanking);
        User.hasMany(models.User, {
          'as': 'Friends',
          'joinTableName': 'userHasFriends'
        });
        User.belongsToMany(models.User, {
          'as': 'Friends',
          'through': 'userHasFriends'
        });
        User.belongsToMany(models.Achievement, {
          'as': 'UserAchievements',
          'through': 'userHasAchievements'
        });
        User.hasMany(models.UserNotification);
        User.hasMany(models.UserMessage);
        User.hasOne(models.UserPhoto);
      }
    }
  });
  return User;
};