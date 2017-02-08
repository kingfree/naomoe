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
    $router->resource('groups', GroupController::class);
    $router->resource('competitions', CompetitionController::class);
    $router->resource('options', OptionController::class);
    $router->resource('pages', PageController::class);
    $router->resource('votes', PoteController::class);
    $router->resource('votelogs', VoteLogController::class);

});
