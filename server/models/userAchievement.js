'use strict';
module.exports = function(sequelize, DataTypes) {
  var UserAchievement = sequelize.define('UserAchievement', {
    title: DataTypes.STRING,
  }, {
    classMethods: {
        associate: function(models) {
            UserAchievement.belongsTo(models.User);
        }
    }
  });
  return UserAchievement;
};
