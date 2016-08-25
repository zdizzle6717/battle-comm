'use strict';
module.exports = {
    up: function(queryInterface, Sequelize) {
        return queryInterface.createTable('NewsPosts', {
            id: {
                allowNull: false,
                autoIncrement: true,
                primaryKey: true,
                type: Sequelize.INTEGER
            },
            UserLoginId: {
                allowNull: false,
                type: Sequelize.INTEGER,
                references: {
                    model: 'UserLogin',
                    key: 'id'
                }
            },
            title: {
                type: Sequelize.STRING
            },
            image: {
                type: Sequelize.STRING
            },
            callout: {
                type: Sequelize.TEXT
            },
            body: {
                type: Sequelize.TEXT
            },
            published: {
                type: Sequelize.BOOLEAN
            },
            featured: {
                type: Sequelize.BOOLEAN
            },
            tags: {
                type: Sequelize.STRING
            },
            manufacturerId: {
              type: Sequelize.STRING
            },
            gameSystem: {
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
        return queryInterface.dropTable('NewsPosts');
    }
};
