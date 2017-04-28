'use strict';

module.exports = function (sequelize, DataTypes) {
  var GameSystemRanking = sequelize.define('GameSystemRanking', {
    'totalWins': {
      'type': DataTypes.INTEGER,
      'defaultValue': 0
    },
    'totalLosses': {
      'type': DataTypes.INTEGER,
      'defaultValue': 0
    },
    'totalDraws': {
      'type': DataTypes.INTEGER,
      'defaultValue': 0
    }
  }, {
    'classMethods': {
      associate: function associate(models) {
        GameSystemRanking.belongsTo(models.User);
        GameSystemRanking.belongsTo(models.GameSystem);
        GameSystemRanking.hasMany(models.FactionRanking);
      }
    },
    'getterMethods': {
      pointValue: function pointValue() {
        return this.totalWins + this.totalDraws * 0.5;
      }
    }
  });
  return GameSystemRanking;
};