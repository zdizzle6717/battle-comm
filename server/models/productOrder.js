'use strict';
module.exports = function(sequelize, DataTypes) {
  var ProductOrder = sequelize.define('ProductOrder', {
    status: DataTypes.STRING,
    orderDetails: DataTypes.STRING,
    orderTotal: DataTypes.INTEGER,
    CustomerId: DataTypes.INTEGER,
    customerFullName: DataTypes.STRING,
    customerEmail: DataTypes.STRING,
    phone: DataTypes.STRING,
    shippingStreet: DataTypes.STRING,
    shippingAppartment: DataTypes.STRING,
    shippingCity: DataTypes.STRING,
    shippingState: DataTypes.STRING,
    shippingZip: DataTypes.STRING,
    shippingCountry: DataTypes.STRING
  }, {
    classMethods: {
        associate: function(models) {
            ProductOrder.belongsTo(models.UserLogin, {as: 'Customer'});
        }
    }
  });
  return ProductOrder;
};
