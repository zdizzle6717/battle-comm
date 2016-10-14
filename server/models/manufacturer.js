'use strict';
module.exports = function(sequelize, DataTypes) {
  var Manufacturer = sequelize.define('Manufacturer', {
    name: DataTypes.STRING,
    description: DataTypes.TEXT,
  }, {
    classMethods: {
        associate: function(models) {
			Manufacturer.hasMany(models.GameSystem);
        }
    }
  });
  return Manufacturer;
};
