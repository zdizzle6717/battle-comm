'use strict';
module.exports = function(sequelize, DataTypes) {
  var BannerSlide = sequelize.define('BannerSlide', {
    'actionText': DataTypes.STRING,
    'title': DataTypes.STRING,
    'text': DataTypes.TEXT,
    'link': DataTypes.STRING,
		'pageName': DataTypes.STRING,
    'priority': DataTypes.INTEGER,
    'isActive': {
			'type': DataTypes.BOOLEAN,
			'default': false
		}
  }, {
      'classMethods': {
          associate: function(models) {
              BannerSlide.hasOne(models.File);
          }
      }
  });
  return BannerSlide;
};
