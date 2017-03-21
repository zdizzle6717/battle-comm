'use strict';
module.exports = function(sequelize, DataTypes) {
  var Product = sequelize.define('Product', {
    'SKU': DataTypes.STRING,
    'name': DataTypes.STRING,
    'price': DataTypes.INTEGER,
    'description': DataTypes.TEXT,
    'color': DataTypes.STRING,
    'tags': DataTypes.STRING,
    'category': DataTypes.STRING,
    'stockQty': DataTypes.INTEGER,
    'inStock': DataTypes.BOOLEAN,
    'filterVal': DataTypes.STRING,
    'displayStatus': DataTypes.BOOLEAN,
    'featured': DataTypes.BOOLEAN,
    'new': DataTypes.BOOLEAN,
    'onSale': DataTypes.BOOLEAN
  }, {
    'classMethods': {
      associate: function(models) {
				Product.hasMany(models.File);
				Product.hasOne(models.Faction);
				Product.hasOne(models.GameSystem);
				Product.hasOne(models.Manufacturer);
      }
    }
  });
  return Product;
};
