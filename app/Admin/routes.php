<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->get('/api/characters', 'APIController@characters');
    $router->get('/api/groups', 'APIController@groups');
    $router->get('/api/competitions', 'APIController@competitions');
    $router->get('/api/options', 'APIController@options');

    $router->get('/import-export', 'APIController@importExport')->name('import-export');
    $router->get('/export/{type}', 'APIController@downloadExcel')->name('export');
    $router->post('/import', 'APIController@importExcel')->name('import');

    $router->get('/generate/{id}', 'APIController@generateGroup')->name('generate');
    $router->post('/generate', 'APIController@doGenerateGroup')->name('doGenerate');

    $router->resource('users', UserController::class);
    $router->resource('characters', CharacterController::class);
    $router->resource('pools', PoolController::class);
    $router->resource('groups', GroupController::class);
    $router->resource('competitions', CompetitionController::class);
    $router->resource('options', OptionController::class);
    $router->resource('pages', PageController::class);
    $router->resource('votes', VoteController::class);
    $router->resource('votelogs', VoteLogController::class);

});
