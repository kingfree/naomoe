'use strict';
module.exports = function (sequelize, DataTypes) {
  var Character = sequelize.define('Character', {
    name_c: DataTypes.STRING,
    name_j: DataTypes.STRING,
    name_e: DataTypes.STRING,
    title_c: DataTypes.STRING,
    title_j: DataTypes.STRING,
    title_e: DataTypes.STRING,
    bio: DataTypes.TEXT
  }, {
    getterMethods: {
      name: function () {
        return this.name_c;
      },
      title: function () {
        return this.title_c;
      }
    },
    classMethods: {
      associate: function (models) {
        // associations can be defined here
      }
    }
  });
  return Character;
};