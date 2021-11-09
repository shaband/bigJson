<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Jobs\AddAcountJob;
use App\Services\ExcelReader;
use App\Services\Source\JsonSource;
use Spatie\SimpleExcel\SimpleExcelReader;

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

$router->get(
    '/',
    function () use ($router) {
        $path=storage_path('challenge.json');
        $source=(new JsonSource)->generate($path);
        AddAcountJob($source);
        $source->next();
        dd($source->key());
    }
);
