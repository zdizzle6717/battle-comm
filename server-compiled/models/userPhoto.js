'use strict';

module.exports = function (sequelize, DataTypes) {
  var UserPhoto = sequelize.define('UserPhoto', {
    'locationUrl': DataTypes.STRING,
    'identifier': DataTypes.STRING,
    'label': DataTypes.STRING,
    'name': DataTypes.STRING,
    'size': DataTypes.INTEGER,
    'type': DataTypes.STRING
  }, {
    'classMethods': {
      associate: function associate(models) {
        UserPhoto.belongsTo(models.User);
      }
    }
  });
  return UserPhoto;
};