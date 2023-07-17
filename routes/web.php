<?php

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api'], function () use ($router) {
    $router->get('/author', 'AuthorController@getAuthors');
    $router->get('/author/{id}', 'AuthorController@getSingleAuthorDetails');
    $router->post('/author', 'AuthorController@storeAuthor');
    $router->patch('/author/{id}', 'AuthorController@updateAuthorDetails');
    $router->delete('/author/{id}','AuthorController@destroyAuthor');
});
