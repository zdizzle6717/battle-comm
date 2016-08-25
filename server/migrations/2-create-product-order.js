'use strict';
module.exports = {
    up: function(queryInterface, Sequelize) {
        return queryInterface.createTable('ProductOrders', {
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
            status: {
                type: Sequelize.STRING
            },
            orderDetails: {
                type: Sequelize.STRING
            },

            orderTotal: {
                type: Sequelize.INTEGER
            },
            customerFullName: {
                type: Sequelize.STRING
            },
            customerEmail: {
                type: Sequelize.STRING
            },
            phone: {
                type: Sequelize.STRING
            },
            shippingStreet: {
                type: Sequelize.STRING
            },
            shippingAppartment: {
                type: Sequelize.STRING
            },
            shippingCity: {
                type: Sequelize.STRING
            },
            shippingState: {
                type: Sequelize.STRING
            },
            shippingZip: {
                type: Sequelize.STRING
            },
            shippingCountry: {
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
        return queryInterface.dropTable('ProductOrders');
    }
};
