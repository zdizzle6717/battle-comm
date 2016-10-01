'use strict';
module.exports = function(sequelize, DataTypes) {
  var UserNotification = sequelize.define('UserNotification', {
    status: DataTypes.STRING,
  }, {
    classMethods: {
        associate: function(models) {
            UserNotification.belongsTo(models.User);
        }
    }
  });
  return UserNotification;
};
