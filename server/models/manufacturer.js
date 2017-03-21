'use strict';
module.exports = function(sequelize, DataTypes) {
  var Manufacturer = sequelize.define('Manufacturer', {
    'name': DataTypes.STRING,
    'searchKey': DataTypes.STRING,
    'description': DataTypes.TEXT,
    'url': DataTypes.STRING
  }, {
    'classMethods': {
      associate: function(models) {
				Manufacturer.hasOne(models.File);
        Manufacturer.hasMany(models.GameSystem);
      }
    }
  });
  return Manufacturer;
};
