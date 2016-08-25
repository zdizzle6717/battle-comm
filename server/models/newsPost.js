'use strict';
module.exports = function(sequelize, DataTypes) {
  var NewsPost = sequelize.define('NewsPost', {
    title: DataTypes.STRING,
    image: DataTypes.STRING,
    callout: DataTypes.TEXT,
    body: DataTypes.TEXT,
    published: DataTypes.BOOLEAN,
    featured: DataTypes.BOOLEAN,
    tags: DataTypes.STRING,
    manufacturerId: DataTypes.STRING,
    gameSystem: DataTypes.STRING,
    category: DataTypes.STRING
  }, {
      classMethods: {
          associate: function(models) {
              NewsPost.belongsTo(models.user_login);
          }
      }
  });
  return NewsPost;
};
