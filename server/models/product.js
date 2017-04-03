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
    'filterVal': {
			'type': DataTypes.STRING,
			'defaultValue': 'showit'
		},
    'displayStatus': DataTypes.BOOLEAN,
    'featured': DataTypes.BOOLEAN,
    'new': DataTypes.BOOLEAN,
    'onSale': DataTypes.BOOLEAN
  }, {
    'classMethods': {
      associate: function(models) {
				Product.hasMany(models.File);
				Product.belongsTo(models.Faction);
				Product.belongsTo(models.GameSystem);
				Product.belongsTo(models.Manufacturer);
      }
    }
  });
  return Product;
};
