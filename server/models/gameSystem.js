'use strict';
module.exports = function(sequelize, DataTypes) {
  var GameSystem = sequelize.define('GameSystem', {
    name: DataTypes.STRING,
	description: DataTypes.TEXT,
	searchKey: DataTypes.STRING,
	photo: DataTypes.STRING,
	url: DataTypes.STRING
  }, {
    classMethods: {
        associate: function(models) {
			GameSystem.hasMany(models.GameSystemRanking);
			GameSystem.belongsTo(models.Manufacturer);
			GameSystem.hasMany(models.Faction);
        }
    }
  });
  return GameSystem;
};
