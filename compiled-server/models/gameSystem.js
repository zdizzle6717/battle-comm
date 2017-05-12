'use strict';

module.exports = function (sequelize, DataTypes) {
  var GameSystem = sequelize.define('GameSystem', {
    'name': DataTypes.STRING,
    'description': DataTypes.TEXT,
    'url': DataTypes.STRING
  }, {
    'classMethods': {
      associate: function associate(models) {
        GameSystem.hasOne(models.File);
        GameSystem.belongsTo(models.Manufacturer);
        GameSystem.hasMany(models.Achievement);
        GameSystem.hasMany(models.Faction);
        GameSystem.hasMany(models.GameSystemRanking);
        GameSystem.hasMany(models.NewsPost);
        GameSystem.hasMany(models.Product);
      }
    }
  });
  return GameSystem;
};