'use strict';
module.exports = function(sequelize, DataTypes) {
    var UserRanking = sequelize.define('UserRanking', {
        totalWins: {
            type: DataTypes.INTEGER,
            defaultValue: 0
        },
        totalLosses: {
            type: DataTypes.INTEGER,
            defaultValue: 0
        },
        totalDraws: {
            type: DataTypes.INTEGER,
            defaultValue: 0
        }
    }, {
        classMethods: {
            associate: function(models) {
                UserRanking.belongsTo(models.User);
                UserRanking.hasOne(models.GameSystem);
                UserRanking.hasOne(models.Faction);
            }
        }
    });
    return UserRanking;
};
