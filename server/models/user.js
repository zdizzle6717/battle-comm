'use strict';
module.exports = function(sequelize, DataTypes) {
    var User = sequelize.define('User', {
		email: {
			type: DataTypes.STRING,
			unique: true
		},
        password: DataTypes.STRING,
        firstName: DataTypes.STRING,
        lastName: DataTypes.STRING,
		subscriber: {
			type: DataTypes.BOOLEAN,
			defaultValue: true
		},
        tourneyAdmin: {
			type: DataTypes.BOOLEAN,
			defaultValue: false
		},
        eventAdmin: {
			type: DataTypes.BOOLEAN,
			defaultValue: false
		},
        newsContributor: {
			type: DataTypes.BOOLEAN,
			defaultValue: false
		},
        venueAdmin: {
			type: DataTypes.BOOLEAN,
			defaultValue: false
		},
        clubAdmin: {
			type: DataTypes.BOOLEAN,
			defaultValue: false
		},
        systemAdmin: {
			type: DataTypes.BOOLEAN,
			defaultValue: false
		},
		username:  {
			type: DataTypes.STRING,
			unique: true
		},
        club: DataTypes.INTEGER,
        mainPhone: DataTypes.STRING,
        mobilePhone: DataTypes.STRING,
        streetAddress: DataTypes.STRING,
        aptSuite: DataTypes.STRING,
        city: DataTypes.STRING,
        state: DataTypes.STRING,
        zip: DataTypes.STRING,
        dob: DataTypes.DATE,
        bio: DataTypes.TEXT,
        facebook: DataTypes.STRING,
        twitter: DataTypes.STRING,
        instagram: DataTypes.STRING,
        googlePlus: DataTypes.STRING,
        youtube: DataTypes.STRING,
        twitch: DataTypes.STRING,
        website: DataTypes.STRING,
        rewardPoints: DataTypes.INTEGER,
        visibility: DataTypes.STRING,
        shareContact: DataTypes.STRING,
        shareName: DataTypes.STRING,
        shareStatus: DataTypes.STRING,
        newsletter: DataTypes.STRING,
        marketing: DataTypes.STRING,
        sms: DataTypes.STRING,
        allowPlay: DataTypes.STRING,
        icon: DataTypes.STRING,
        totalWins: DataTypes.INTEGER,
        totalLosses: DataTypes.INTEGER,
        totalDraws: DataTypes.INTEGER,
        totalPoints: DataTypes.INTEGER,
        eloRanking: DataTypes.INTEGER,
        accountActive: DataTypes.STRING
    }, {
        classMethods: {
            associate: function(models) {
				User.hasMany(models.ProductOrder);
				User.hasMany(models.User, { as: 'Friends', joinTableName: 'userHasFriends'})
				User.hasMany(models.UserNotification);
                User.hasMany(models.UserMessage);
                User.hasMany(models.UserAchievement);
                User.hasMany(models.UserPhoto);
            }
        }
    });
    return User;
};
