<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Services\ExcelReader;
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

    /*
     "credit_card/type" => "Visa"
  "credit_card/number" => "4532383564703"
  "credit_card/name" => "Brooks Hudson"
  "credit_card/expirationDate" => "12/19"
   */
        $s=SimpleExcelReader::create(storage_path('challenge.csv'));

        $w=new ExcelReader(storage_path('challenge.csv'), 0);
        $w->store();
    }
);
