<?php

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api/author'], function () use ($router) {
    $router->get('/', 'AuthorController\Author@getAuthors');
    $router->get('/{id}', 'AuthorController\Author@getSingleAuthorDetails');
    $router->post('/', 'AuthorController\Author@storeAuthor');
    $router->patch('/{id}', 'AuthorController\Author@updateAuthorDetails');
    $router->delete('/{id}','AuthorController\Author@destroyAuthor');
});

$router->group(['prefix'=>'api/book'], function () use ($router) {
    $router->get('/','BookController\Book@getBooks');
    $router->get('/{id}','BookController\Book@getBookByID');
    $router->post('/','BookController\Book@storeBook');
    $router->patch('/{id}','BookController\Book@updateBook');
});

$router->group(['prefix'=>'api/comment'], function () use ($router) {
    $router->get('/','CommentController\Comment@getComment');
    $router->post('/','CommentController\Comment@storeComment');
});
