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
			GameSystem.belongsTo(models.UserRanking);
			GameSystem.belongsTo(models.Manufacturer);
        }
    }
  });
  return GameSystem;
};
