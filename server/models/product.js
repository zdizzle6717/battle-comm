'use strict';
module.exports = function(sequelize, DataTypes) {
  var Product = sequelize.define('Product', {
    'SKU': DataTypes.STRING,
    'name': DataTypes.STRING,
    'price': DataTypes.INTEGER,
    'description': DataTypes.TEXT,
    'manufacturerId': DataTypes.STRING,
    'gameSystem': DataTypes.STRING,
    'color': DataTypes.STRING,
    'tags': DataTypes.STRING,
    'category': DataTypes.STRING,
    'stockQty': DataTypes.INTEGER,
    'inStock': DataTypes.BOOLEAN,
    'filterVal': DataTypes.STRING,
    'displayStatus': DataTypes.BOOLEAN,
    'featured': DataTypes.BOOLEAN,
    'new': DataTypes.BOOLEAN,
    'onSale': DataTypes.BOOLEAN,
    'imgAlt': DataTypes.STRING,
    'imgOneFront': DataTypes.STRING,
    'imgOneBack': DataTypes.STRING,
    'imgTwoFront': DataTypes.STRING,
    'imgTwoBack': DataTypes.STRING,
    'imgThreeFront': DataTypes.STRING,
    'imgThreeBack': DataTypes.STRING,
    'imgFourFront': DataTypes.STRING,
    'imgFourBack': DataTypes.STRING,
  }, {
    'classMethods': {
      associate: function(models) {
				Product.hasMany(models.File);
      }
    }
  });
  return Product;
};
