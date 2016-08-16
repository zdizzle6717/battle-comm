'use strict';
module.exports = {
  up: function(queryInterface, Sequelize) {
    return queryInterface.createTable('UserLogins', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      email: {
        type: Sequelize.STRING
      },
      password: {
        type: Sequelize.STRING
      },
      activation_key: {
        type: Sequelize.STRING
      },
      activation_state: {
        type: Sequelize.INTEGER
      },
      firstName: {
        type: Sequelize.STRING
      },
      lastName: {
        type: Sequelize.STRING
      },
      join_date: {
        type: Sequelize.DATE
      },
      tourneyAdmin: {
        type: Sequelize.STRING
      },
      EventAdmin: {
        type: Sequelize.STRING
      },
      NewsContributor: {
        type: Sequelize.STRING
      },
      venueAdmin: {
        type: Sequelize.STRING
      },
      clubAdmin: {
        type: Sequelize.STRING
      },
      siteAdmin: {
        type: Sequelize.STRING
      },
      user_handle: {
        type: Sequelize.STRING
      },
      user_club: {
        type: Sequelize.INTEGER
      },
      user_main_phone: {
        type: Sequelize.STRING
      },
      user_mobile_phone: {
        type: Sequelize.STRING
      },
      user_work_phone: {
        type: Sequelize.STRING
      },
      user_street_address: {
        type: Sequelize.STRING
      },
      user_apt_suite: {
        type: Sequelize.STRING
      },
      user_city: {
        type: Sequelize.STRING
      },
      user_state: {
        type: Sequelize.STRING
      },
      user_zip: {
        type: Sequelize.STRING
      },
      user_Date_of_Birth: {
        type: Sequelize.DATE
      },
      user_bio: {
        type: Sequelize.TEXT
      },
      user_facebook: {
        type: Sequelize.STRING
      },
      user_twitter: {
        type: Sequelize.STRING
      },
      user_instagram: {
        type: Sequelize.STRING
      },
      user_google_plus: {
        type: Sequelize.STRING
      },
      user_youtube: {
        type: Sequelize.STRING
      },
      user_twitch: {
        type: Sequelize.STRING
      },
      user_website: {
        type: Sequelize.STRING
      },
      user_points: {
        type: Sequelize.INTEGER
      },
      user_visibility: {
        type: Sequelize.STRING
      },
      user_share_contact: {
        type: Sequelize.STRING
      },
      user_share_name: {
        type: Sequelize.STRING
      },
      user_share_status: {
        type: Sequelize.STRING
      },
      user_newsletter: {
        type: Sequelize.STRING
      },
      user_marketing: {
        type: Sequelize.STRING
      },
      user_sms: {
        type: Sequelize.STRING
      },
      user_allow_play: {
        type: Sequelize.STRING
      },
      user_icon: {
        type: Sequelize.STRING
      },
      totalWins: {
        type: Sequelize.INTEGER
      },
      totalLoss: {
        type: Sequelize.INTEGER
      },
      totalDraw: {
        type: Sequelize.INTEGER
      },
      totalPoints: {
        type: Sequelize.INTEGER
      },
      accountActive: {
        type: Sequelize.STRING
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE
      }
    });
  },
  down: function(queryInterface, Sequelize) {
    return queryInterface.dropTable('UserLogins');
  }
};
