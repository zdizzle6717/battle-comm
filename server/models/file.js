'use strict';

module.exports = function(sequelize, DataTypes) {
  let File = sequelize.define('File', {
    'locationUrl': DataTypes.STRING,
    'label': DataTypes.STRING,
    'name': DataTypes.STRING,
    'size': DataTypes.INTEGER,
    'type': DataTypes.STRING,
    'identifier': {
      'type': DataTypes.STRING,
      'defaultValue': 'default'
    }
  }, {
    'classMethods': {
      associate: function(models) {
        File.belongsTo(models.BannerSlide);
        File.belongsTo(models.GameSystem);
        File.belongsTo(models.Manufacturer);
        File.belongsTo(models.NewsPost);
        File.belongsTo(models.Product);
        File.belongsTo(models.User);
        File.belongsTo(models.UserAchievement);
      }
    }
  });
  return File;
};
