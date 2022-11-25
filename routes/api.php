<?php

use App\Http\Controllers\Api\FlightControllers;
use App\Http\Controllers\Api\GasControllers;
use App\Http\Controllers\Api\TempControllers;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'v1'

// ], function ($router) {
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::prefix('/auth')->middleware('api')->group(function () {
//     Route::post('login', 'APIController@login');
//     Route::post('logout', 'APIController@logout');
// });
Route::post('login', 'APIController@login');
Route::post('logout', 'APIController@logout');

Route::post('quen-mat-khau', 'APIController@quenMatKhau');

Route::get('temp/data', [TempControllers::class, 'getData']);
Route::get('temp/chart', [TempControllers::class, 'getChart']);
Route::get('gas/data', [GasControllers::class, 'getData']);
Route::get('gas/chart', [GasControllers::class, 'getChart']);
Route::get('lights/data', [FlightControllers::class, 'getData']);
Route::post('lights/turn-on', [FlightControllers::class, 'turnOn']);
Route::post('lights/turn-off', [FlightControllers::class, 'turnOff']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user-info', 'APIcontroller@getUserInfo');
    Route::get('get-notification', 'APIController@getNotification');
});

Route::middleware('jwt.auth')->group(function () {
    Route::put('cap-nhat-tai-khoan/{id}', 'APIController@capNhat');
});
