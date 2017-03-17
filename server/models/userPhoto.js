'use strict';
module.exports = function(sequelize, DataTypes) {
  var UserPhoto = sequelize.define('UserPhoto', {
    url: DataTypes.STRING,
  }, {
    classMethods: {
      associate: function(models) {
        UserPhoto.belongsTo(models.User);
      }
    }
  });
  return UserPhoto;
};
