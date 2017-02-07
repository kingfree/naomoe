<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->get('/api/characters', 'APIController@characters');

    $router->resource('users', UserController::class);
    $router->resource('characters', CharacterController::class);
    $router->resource('pools', PoolController::class);

});
