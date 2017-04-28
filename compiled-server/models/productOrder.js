'use strict';

module.exports = function (sequelize, DataTypes) {
  var ProductOrder = sequelize.define('ProductOrder', {
    'status': DataTypes.STRING,
    'orderDetails': DataTypes.TEXT,
    'productDetails': DataTypes.JSONB,
    'orderTotal': DataTypes.INTEGER,
    'customerFullName': DataTypes.STRING,
    'customerEmail': DataTypes.STRING,
    'phone': DataTypes.STRING,
    'shippingStreet': DataTypes.STRING,
    'shippingApartment': DataTypes.STRING,
    'shippingCity': DataTypes.STRING,
    'shippingState': DataTypes.STRING,
    'shippingZip': DataTypes.STRING,
    'shippingCountry': DataTypes.STRING
  }, {
    'classMethods': {
      associate: function associate(models) {
        ProductOrder.belongsTo(models.User);
      }
    }
  });
  return ProductOrder;
};