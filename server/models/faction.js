'use strict';
module.exports = function(sequelize, DataTypes) {
  var Faction = sequelize.define('Faction', {
    name: DataTypes.STRING
  }, {
    classMethods: {
        associate: function(models) {
			Faction.belongsTo(models.GameSystem);
			Faction.hasMany(models.FactionRanking);
        }
    }
  });
  return Faction;
};
