'use strict';
module.exports = {
  up: function(queryInterface, Sequelize) {
    return queryInterface.createTable('Products', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      SKU: {
        type: Sequelize.STRING
      },
      name: {
        type: Sequelize.STRING
      },
      price: {
        type: Sequelize.STRING
      },
      description: {
        type: Sequelize.STRING
      },
      manufacturerId: {
        type: Sequelize.STRING
      },
      gameSystem: {
        type: Sequelize.STRING
      },
      color: {
        type: Sequelize.STRING
      },
      tags: {
        type: Sequelize.STRING
      },
      category: {
        type: Sequelize.STRING
      },
      stockQty: {
        type: Sequelize.INTEGER
      },
      inStock: {
        type: Sequelize.BOOLEAN
      },
      filterVal: {
        type: Sequelize.STRING
      },
      displayStatus: {
        type: Sequelize.BOOLEAN
      },
      featured: {
        type: Sequelize.BOOLEAN
      },
      new: {
        type: Sequelize.BOOLEAN
      },
      onSale: {
        type: Sequelize.BOOLEAN
      },
      imgAlt: {
        type: Sequelize.STRING
      },
      imgOneFront: {
        type: Sequelize.STRING
      },
      imgOneBack: {
        type: Sequelize.STRING
      },
      imgTwoFront: {
        type: Sequelize.STRING
      },
      imgTwoBack: {
        type: Sequelize.STRING
      },
      imgThreeFront: {
        type: Sequelize.STRING
      },
      imgThreeBack: {
        type: Sequelize.STRING
      },
      imgFourFront: {
        type: Sequelize.STRING
      },
      imgFourBack: {
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
    return queryInterface.dropTable('Products');
  }
};
