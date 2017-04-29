'use strict';

module.exports = function (sequelize, DataTypes) {
  var Faction = sequelize.define('Faction', {
    'name': DataTypes.STRING
  }, {
    'classMethods': {
      associate: function associate(models) {
        Faction.belongsTo(models.GameSystem);
        Faction.hasMany(models.FactionRanking);
        Faction.hasMany(models.NewsPost);
        Faction.hasMany(models.Product);
      }
    }
  });
  return Faction;
};