'use strict';

module.exports = function (sequelize, DataTypes) {
  var Product = sequelize.define('Product', {
    'SKU': DataTypes.STRING,
    'name': DataTypes.STRING,
    'price': DataTypes.INTEGER,
    'description': DataTypes.TEXT,
    'color': DataTypes.STRING,
    'tags': DataTypes.STRING,
    'category': DataTypes.STRING,
    'stockQty': DataTypes.INTEGER,
    'isDisplayed': DataTypes.BOOLEAN,
    'isFeatured': DataTypes.BOOLEAN,
    'isNew': DataTypes.BOOLEAN,
    'isOnSale': DataTypes.BOOLEAN
  }, {
    'classMethods': {
      associate: function associate(models) {
        Product.hasMany(models.File);
        Product.belongsTo(models.Faction);
        Product.belongsTo(models.GameSystem);
        Product.belongsTo(models.Manufacturer);
      }
    },
    'getterMethods': {
      isInStock: function isInStock() {
        return this.stockQty > 0;
      }
    }
  });
  return Product;
};