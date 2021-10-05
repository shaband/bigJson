<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Jobs\FileHandler;
use App\Jobs\InsertJob;
use Illuminate\Support\Facades\File;
use \JsonMachine\JsonMachine;

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

$router->get('/', function () use ($router) {
    dispatch(new InsertJob());
});
