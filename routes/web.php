<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Jobs\AddAcountJob;
use App\Jobs\InsertJob;
use App\Models\Account;
use App\Rules\ValidAgeRule;
use App\Services\Reader;
use App\Services\ReaderAbstract;
use App\Services\Validator\AgeValidator;
use Illuminate\Support\Facades\Validator;

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
    return 'hello';
});
