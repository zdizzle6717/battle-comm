'use strict';
module.exports = function(sequelize, DataTypes) {
  var UserFriend = sequelize.define('UserFriend', {
    iconUrl: DataTypes.STRING,
    friendId: DataTypes.STRING
  }, {
    classMethods: {
        associate: function(models) {
            UserFriend.belongsTo(models.User);
        }
    }
  });
  return UserFriend;
};
