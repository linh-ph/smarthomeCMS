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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'

], function ($router) {
    Route::get('/login', function (Request $request) {
        return 'demo';
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/auth')->middleware('api')->group(function () {
    Route::post('login', 'APIController@login');
    Route::post('logout', 'APIController@logout');
});
Route::post('login', 'APIController@login');
Route::post('logout', 'APIController@logout');

Route::post('quen-mat-khau', 'APIController@quenMatKhau');
Route::put('cap-nhat-tai-khoan/{id}', 'APIController@capNhat');
Route::middleware(['assign.guard:api', 'jwt.auth'])->group(function () {
    Route::get('user-info', 'APIcontroller@getUserInfo');
});