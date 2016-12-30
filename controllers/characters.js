var models = require('../models');

module.exports = [
  {
    method: 'GET',
    path: '/character/list',
    handler: function (request, reply) {
      reply(models.Character.findAll())
      //
      // reply({
      //   characters: [
      //     {name: '新子憧', title: '天才麻将少女'},
      //     {name: '九条可怜', title: '黄金拼图'},
      //     {name: '由比滨结衣', title: '我的青春恋爱物语果然有问题'},
      //     {name: '桐崎千棘', title: '伪恋'},
      //     {name: '中川花音', title: '只有神知道的世界'}
      //   ]
      // })
    }
  },
  {
    method: 'POST',
    path: '/character/add',
    handler: function (request, reply) {
      models.Character.create(request.body)
        .then(function (character) {
          reply(character)
        })
        .catch(function (e) {
          reply.statusCode(400)
          reply(e)
        })
    }
  },
  {
    method: 'POST',
    path: '/character/edit',
    handler: function (request, reply) {
      models.Character.findOne(request.body.id)
        .then(function (character) {
          character.update(request.body)
            .then(function () {
              reply(character)
            })
        })
        .catch(function (e) {
          reply.statusCode(400);
          reply(e)
        })
    }
  }
];
