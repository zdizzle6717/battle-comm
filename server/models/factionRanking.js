'use strict';
module.exports = function(sequelize, DataTypes) {
    var FactionRanking = sequelize.define('FactionRanking', {
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
                FactionRanking.belongsTo(models.Faction);
                FactionRanking.belongsTo(models.GameSystemRanking);
            }
        },
		getterMethods: {
			pointValue: function() {
				return this.totalWins + (this.totalDraws * .5);
			}
		}
    });
    return FactionRanking;
};
