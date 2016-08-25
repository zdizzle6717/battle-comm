'use strict';
module.exports = function(sequelize, DataTypes) {
    var user_login = sequelize.define('user_login', {
        email: DataTypes.STRING,
        password: DataTypes.STRING,
        activation_key: DataTypes.STRING,
        activation_state: DataTypes.INTEGER,
        firstName: DataTypes.STRING,
        lastName: DataTypes.STRING,
        join_date: DataTypes.DATE,
        tourneyAdmin: DataTypes.STRING,
        EventAdmin: DataTypes.STRING,
        NewsContributor: DataTypes.STRING,
        venueAdmin: DataTypes.STRING,
        clubAdmin: DataTypes.STRING,
        siteAdmin: DataTypes.STRING,
        user_handle: DataTypes.STRING,
        user_club: DataTypes.INTEGER,
        user_main_phone: DataTypes.STRING,
        user_mobile_phone: DataTypes.STRING,
        user_work_phone: DataTypes.STRING,
        user_street_address: DataTypes.STRING,
        user_apt_suite: DataTypes.STRING,
        user_city: DataTypes.STRING,
        user_state: DataTypes.STRING,
        user_zip: DataTypes.STRING,
        user_Date_of_Birth: DataTypes.DATE,
        user_bio: DataTypes.TEXT,
        user_facebook: DataTypes.STRING,
        user_twitter: DataTypes.STRING,
        user_instagram: DataTypes.STRING,
        user_google_plus: DataTypes.STRING,
        user_youtube: DataTypes.STRING,
        user_twitch: DataTypes.STRING,
        user_website: DataTypes.STRING,
        user_points: DataTypes.INTEGER,
        user_visibility: DataTypes.STRING,
        user_share_contact: DataTypes.STRING,
        user_share_name: DataTypes.STRING,
        user_share_status: DataTypes.STRING,
        user_newsletter: DataTypes.STRING,
        user_marketing: DataTypes.STRING,
        user_sms: DataTypes.STRING,
        user_allow_play: DataTypes.STRING,
        user_icon: DataTypes.STRING,
        totalWins: DataTypes.INTEGER,
        totalLoss: DataTypes.INTEGER,
        totalDraw: DataTypes.INTEGER,
        totalPoints: DataTypes.INTEGER,
        accountActive: DataTypes.STRING
    }, {
        freezeTableName: true,
        classMethods: {
            associate: function(models) {
                user_login.hasMany(models.ProductOrder);
            }
        }
    });
    return user_login;
};
