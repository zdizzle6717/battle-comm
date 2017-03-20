'use strict';
module.exports = function(sequelize, DataTypes) {
  var UserAchievement = sequelize.define('UserAchievement', {
    'title': DataTypes.STRING,
  }, {
    'classMethods': {
        associate: function(models) {
						UserAchievement.hasOne(models.File);
            UserAchievement.belongsTo(models.User);
        }
    }
  });
  return UserAchievement;
};
