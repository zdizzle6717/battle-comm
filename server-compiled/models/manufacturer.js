'use strict';

module.exports = function (sequelize, DataTypes) {
  var Manufacturer = sequelize.define('Manufacturer', {
    'name': DataTypes.STRING,
    'description': DataTypes.TEXT,
    'url': DataTypes.STRING
  }, {
    'classMethods': {
      associate: function associate(models) {
        Manufacturer.hasOne(models.File);
        Manufacturer.hasMany(models.GameSystem);
        Manufacturer.hasMany(models.NewsPost);
        Manufacturer.hasMany(models.Product);
      }
    }
  });
  return Manufacturer;
};