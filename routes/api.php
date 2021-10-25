<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function ($router) {
    
    $router->get('/weather/{city_id}', [
        'as' => 'weather',
        'uses' => 'WeatherController@weatherInfo',
    ])->where('city_id', '[0-9]+');
    
    $router->get('/forecast/{city_id}', [
        'as' => 'forecast',
        'uses' => 'WeatherController@forecastInfo',
    ])->where('city_id', '[0-9]+');
    
    $router->post('/city', [
        'as' => 'add-city',
        'uses' => 'UserController@saveCity'
    ]);
    $router->delete('/city/{city_id}', [
        'as' => 'delete-city',
        'uses' => 'UserController@removeCity'
    ])->where('city_id', '[0-9]+');

    $router->get('/city', [
        'as' => 'get-city',
        'uses' => 'UserController@getUserCities'
    ]);
});