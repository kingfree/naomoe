'use strict';

const Hapi = require('hapi');
const Inert = require('inert');
const path = require('path');
const h2o2 = require('h2o2');
const settings = require('config');

const routes = require('./routes');
const models = require('./models');

const server = new Hapi.Server({
  connections: {
    routes: {
      cors: settings.cors
    }
  }
});
server.connection({
  port: settings.port,
  host: settings.host
});

var initDb = function (cb) {
  var sequelize = models.sequelize;

  //Test if we're in a sqlite memory database. we may need to run migrations.
  if (sequelize.getDialect() === 'sqlite' &&
    (!sequelize.options.storage || sequelize.options.storage === ':memory:')) {
    sequelize.getMigrator({
      path: process.cwd() + '/migrations',
    }).migrate().success(function () {
      // The migrations have been executed!
      cb();
    });
  } else {
    cb();
  }
};

var setup = function (done) {

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
    }, {
      register: h2o2
    }], function (err) {
      if (err) {
        throw err;
      }
    });

  }
  //Register all plugins
  server.register([Inert], function (err) {
    if (err) {
      throw err; // something bad happened loading a plugin
    }
  });

  // Add the server routes
  server.route(routes);


  if (process.env.NODE_ENV !== 'production') {
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
          path: __dirname + '/static/',
          listing: false,
          index: false
        }
      }
    });

    server.route({
      method: 'GET',
      path: '/{path*}',
      handler: {
        proxy: {
          uri: 'http://localhost:3000/'
        }
      }
    });
  } else {
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

    server.route({
      method: 'GET',
      path: '/{path*}',
      handler: function (request, reply) {
        reply.file('./dist/index.html');
      }
    });
  }

  initDb(function () {
    done();
  });
};

var start = function () {
  server.start(function () {
    server.log('info', 'Server running at: ' + server.info.uri);
  });
};

// If someone runs: "node server.js" then automatically start the server
if (path.basename(process.argv[1], '.js') == path.basename(__filename, '.js')) {
  setup(function () {
    start();
  });
}

module.exports = server;
