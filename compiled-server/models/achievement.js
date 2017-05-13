'use strict';

module.exports = function (sequelize, DataTypes) {
  var Achievement = sequelize.define('Achievement', {
    'title': {
      'type': DataTypes.STRING,
      'unique': true
    },
    'category': DataTypes.STRING,
    'description': DataTypes.TEXT,
    'priority': DataTypes.INTEGER,
    'rpValue': DataTypes.INTEGER
  }, {
    'classMethods': {
      associate: function associate(models) {
        Achievement.hasOne(models.File);
        Achievement.belongsTo(models.GameSystem);
        Achievement.belongsToMany(models.User, {
          'through': 'userHasAchievements'
        });
      }
    }
  });
  return Achievement;
};