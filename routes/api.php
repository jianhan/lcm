<?php

use Illuminate\Http\Request;

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

Route::get('auth/redirect/{provider}', 'Auth\LoginController@redirect');
Route::get('auth/callback/{provider}', 'Auth\LoginController@callback');

Route::get('/user', function (Request $request) {
    return $request->user();
});


$api = app('Dingo\Api\Routing\Router');
$api->version('v1',
    [
        'prefix' => 'api/v1',
        'namespace' => 'App\Api\V1\Controllers',
        'middleware' => ['cors', \App\Api\Http\Middleware\TimeParser::class, \App\Api\Http\Middleware\VueTable2::class]
    ], function ($api) {
    // User group
    $api->group(['middleware' => 'auth:api'], function ($api) {
        $api->resource('courses', 'CourseController');
        $api->post('upload', 'FileController@upload');
    });
});