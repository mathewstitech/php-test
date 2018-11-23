<?php


use Pecee\SimpleRouter\SimpleRouter as Router;

use Pecee\Http\Request;
use Handlers\Exceptionhandler;

$currentDirectory = $_ENV['CURRENT_DIRECTORY'];

Router::group(['prefix' => $currentDirectory], function () {
    Router::get('/', function ()    {
    	//return 'Hello world';
    	header('location: /recipes/api/list_recipe.php');
    });
	Router::get('/{id}', function($id) {
	    header('location: /recipes/api/get_recipe.php?id='.$id);
	});
	Router::post('/login', function() {
	    header('location: /recipes/api/login.php');
	});
	Router::put('/{id}', function($id) {
		header('location: /recipes/api/update_recipe.php?id='.$id);
	});
	Router::delete('/{id}', function($id) {
		header('location: /recipes/api/delete_recipe.php?id='.$id);
	});
	Router::post('/{id}/rating', function($id) {
		header('location: /recipes/api/create_rating.php?id='.$id);
	});

});
