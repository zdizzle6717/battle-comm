'use strict';

module.exports = function(sequelize, DataTypes) {
  let UserPhoto = sequelize.define('UserPhoto', {
    locationUrl: DataTypes.STRING,
    identifier: DataTypes.STRING,
    label: DataTypes.STRING,
    name: DataTypes.STRING,
    size: DataTypes.INTEGER,
    type: DataTypes.STRING
  }, {
    classMethods: {
      associate: function(models) {
        UserPhoto.belongsTo(models.User);
      }
    }
  });
  return UserPhoto;
};
