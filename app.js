'use strict';

const Hapi = require('hapi');
const Inert = require('inert');

const server = new Hapi.Server();
server.connection({
  port: 3000
});

// Register webpack HMR, fallback to development environment
if (process.env.NODE_ENV !== 'production' && process.env.NODE_ENV !== 'test') {

  const WebpackConfig = require('./build/webpack.dev.conf'); // Webpack config
  const HapiWebpackDevMiddleware = require('hapi-webpack-dev-middleware');
  const HapiWebpackHotMiddleware = require('hapi-webpack-hot-middleware');

  server.register([{
    register: HapiWebpackDevMiddleware,
    options: {
      config: WebpackConfig,
      options: {
        noInfo: true,
        publicPath: WebpackConfig.output.publicPath,
        stats: {
          colors: true
        }
      }
    }
  }, {
    register: HapiWebpackHotMiddleware
  }], function (err) {
    if (err) {
      throw err;
    }
  });

}

server.register([Inert], function (err) {

  if (err) {
    throw err;
  }

  server.route({
    method: 'GET',
    path: '/static/{filepath*}',
    config: {
      auth: false,
      cache: {
        expiresIn: 24 * 60 * 60 * 1000,
        privacy: 'public'
      }
    },
    handler: {
      directory: {
        path: __dirname + '/dist/static/',
        listing: false,
        index: false
      }
    }
  });

  // Example api call
  server.route({
    method: 'GET',
    path: '/character/list',
    handler: function (request, reply) {
      reply({
        code: 0, info: '', data: [
          {name: '新子憧', title: '天才麻将少女'},
          {name: '九条可怜', title: '黄金拼图'},
          {name: '由比滨结衣', title: '我的青春恋爱物语果然有问题'},
          {name: '桐崎千棘', title: '伪恋'},
          {name: '中川花音', title: '只有神知道的世界'}
        ]
      })
    }
  });

  server.route({
    method: 'GET',
    path: '/{path*}',
    handler: function (request, reply) {
      reply.file('./dist/index.html');
    }
  });
});

server.start((err) => {

  if (err) {
    throw err;
  }
  console.log('Server running at:', server.info.uri);
});

module.exports = server;
