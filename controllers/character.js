var models = require('../models');

import Joi from 'joi';

module.exports = [
  {
    method: 'GET',
    path: '/character/list',
    handler: function (request, reply) {
      models.Character.findAll({
        order: ['id']
      }).then(function (characters) {
        reply({code: 0, info: 'ok', data: characters})
      }).error(function (e) {
        throw(e)
      })
    }
  },
  {
    method: 'POST',
    path: '/character/add',
    config: {
      validate: {
        options: {
          allowUnknown: true
        },
        payload: {
          name_j: Joi.string().required(),
          name_c: Joi.string().required(),
          name_e: Joi.string().optional(),
          title_j: Joi.string().required(),
          title_c: Joi.string().required(),
          title_e: Joi.string().optional(),
          bio: Joi.string().optional()
        }
      }
    },
    handler: function (request, reply) {
      models.Character.create(request.payload).then(function (character) {
        reply({code: 0, info: 'ok', data: character})
      }).catch(function (e) {
        throw(e)
      })
    }
  },
  {
    method: 'POST',
    path: '/character/edit',
    config: {
      validate: {
        options: {
          allowUnknown: true
        },
        payload: {
          id: Joi.number().integer().required(),
          name_j: Joi.string().required(),
          name_c: Joi.string().required(),
          name_e: Joi.string().allow('').optional(),
          title_j: Joi.string().required(),
          title_c: Joi.string().required(),
          title_e: Joi.string().allow('').optional(),
          bio: Joi.string().allow('').optional()
        }
      }
    },
    handler: function (request, reply) {
      models.Character.update(request.payload, {
        fields: ['name_j', 'name_c', 'name_e', 'title_j', 'title_c', 'title_e', 'bio'],
        where: {id: request.payload.id},
        returning: true,
        plain: true
      }).then(function (character) {
        reply({code: 0, info: 'ok', data: character[1]})
      }).catch(function (e) {
        throw(e)
      })
    }
  },
  {
    method: 'POST',
    path: '/character/del',
    config: {
      validate: {
        options: {
          allowUnknown: true
        },
        payload: {
          id: Joi.number().integer().required()
        }
      }
    },
    handler: function (request, reply) {
      models.Character.destroy({
        where: {id: request.payload.id}
      }).then(function (rows) {
        if (rows <= 0) {
          reply({code: -1, info: '已删除或不存在'})
        } else {
          reply({code: rows - 1, info: '删除了 ' + rows + ' 行'})
        }
      }).catch(function (e) {
        throw(e)
      })
    }
  }
];
