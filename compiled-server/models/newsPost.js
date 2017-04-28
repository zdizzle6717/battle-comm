'use strict';

module.exports = function (sequelize, DataTypes) {
    var NewsPost = sequelize.define('NewsPost', {
        'title': DataTypes.STRING,
        'callout': DataTypes.TEXT,
        'body': DataTypes.TEXT,
        'published': DataTypes.BOOLEAN,
        'featured': DataTypes.BOOLEAN,
        'tags': DataTypes.STRING,
        'category': DataTypes.STRING
    }, {
        'classMethods': {
            associate: function associate(models) {
                NewsPost.hasMany(models.File);
                NewsPost.belongsTo(models.Faction);
                NewsPost.belongsTo(models.GameSystem);
                NewsPost.belongsTo(models.Manufacturer);
                NewsPost.belongsTo(models.User);
            }
        }
    });
    return NewsPost;
};