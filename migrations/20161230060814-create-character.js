'use strict';
module.exports = {
  up: function(queryInterface, Sequelize) {
    return queryInterface.createTable('Characters', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      name_c: {
        type: Sequelize.STRING
      },
      name_j: {
        type: Sequelize.STRING
      },
      name_e: {
        type: Sequelize.STRING
      },
      title_c: {
        type: Sequelize.STRING
      },
      title_j: {
        type: Sequelize.STRING
      },
      title_e: {
        type: Sequelize.STRING
      },
      bio: {
        type: Sequelize.TEXT
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
    return queryInterface.dropTable('Characters');
  }
};