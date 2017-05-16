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
    $router->post('/api/kanpiao', 'VoteLogController@kanpiao');

    $router->get('/import-export', 'APIController@importExport')->name('import-export');
    $router->get('/export/{type}', 'APIController@downloadExcel')->name('export');
    $router->post('/import', 'APIController@importExcel')->name('import');

    $router->get('/generate/{id}', 'APIController@generateGroup')->name('generation');
    $router->post('/generate', 'APIController@doGenerateGroup')->name('generate');

    $router->get('/calc/{id}', 'APIController@calculate')->name('calculate');

    $router->resource('users', UserController::class);
    $router->resource('characters', CharacterController::class);
    $router->resource('pools', PoolController::class);
    $router->resource('groups', GroupController::class);
    $router->resource('competitions', CompetitionController::class);
    $router->resource('options', OptionController::class);
    $router->resource('pages', PageController::class);
    $router->resource('votelogs', VoteLogController::class);
    $router->resource('schedules', ScheduleController::class);

});

//app('view')->prependNamespace('admin', resource_path('views/admin'));
app('translator')->addNamespace('admin', resource_path('lang/admin'));
