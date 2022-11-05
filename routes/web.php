<?php

use App\Http\Controllers\DashboardControllers;
use App\Http\Controllers\LoginControllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout');
});

Route::get('dang-nhap',[LoginControllers::class, 'loginView'])->name('login')->middleware('guest:web');
Route::post('dang-nhap',[LoginControllers::class, 'doLogin'])->name('xl-dang-nhap');
Route::get('nhiet-do',[DashboardControllers::class, 'callApiDataTemp'])->name('api_nhiet_do');

Route::middleware('auth:web')->group(function(){
	Route::get('dang-xuat','LoginControllers@logout')->name('dang-xuat');
	Route::get('/', function(){
		return view('home');
	})->name('dashboards');
	
	Route::prefix('tinh-nang')->group(function(){
		Route::name('tinh-nang.')->group(function(){
			Route::get('/','FeatureController@index')->name('danh-sach');
			Route::get('xoa/{id}','FeatureController@destroy')->name('xoa');
			Route::get('/them-moi', 'FeatureController@create')->name('them-moi');
			Route::post('/them-moi', 'FeatureController@store')->name('xl-them-moi');
			Route::get('/cap-nhat/{id}', 'FeatureController@edit')->name('cap-nhat');
			Route::post('/cap-nhat/{id}', 'FeatureController@update')->name('xl-cap-nhat');
			Route::get('/thung-rac', 'FeatureController@bin')->name('thung-rac');
			Route::get('restore/{id}','FeatureController@restore')->name('restore');
			Route::get('delete/{id}','FeatureController@delete')->name('delete');
		});
	});

	Route::prefix('nguoi-dung')->group(function(){
		Route::name('nguoi-dung.')->group(function(){
			Route::get('/','UserController@index')->name('danh-sach');
			Route::get('xoa/{id}','UserController@destroy')->name('xoa');
			Route::get('/them-moi', 'UserController@create')->name('them-moi');
			Route::post('/them-moi', 'UserController@store')->name('xl-them-moi');
			Route::get('/cap-nhat/{id}', 'UserController@edit')->name('cap-nhat');
			Route::post('/cap-nhat/{id}', 'UserController@update')->name('xl-cap-nhat');
			Route::get('/thung-rac', 'UserController@bin')->name('thung-rac');
			Route::get('restore/{id}','UserController@restore')->name('restore');
			Route::get('delete/{id}','UserController@delete')->name('delete');
			Route::get('/thong-ke','UserController@ThongkeSoNguoiDangKi')->name('thong-ke');
			Route::get('/thong-ke-diem','UserController@ThongkeNguoiChoiDiemCao')->name('thong-ke-diem');
		});
	});

	Route::prefix('quan-tri-vien')->group(function(){
		Route::name('quan-tri-vien.')->group(function(){
			Route::get('/','QuanTriVienController@index')->name('danh-sach');
			Route::get('xoa/{id}','QuanTriVienController@destroy')->name('xoa');
			Route::get('/them-moi', 'QuanTriVienController@create')->name('them-moi');
			Route::post('/them-moi', 'QuanTriVienController@store')->name('xl-them-moi');
			Route::get('/cap-nhat/{id}', 'QuanTriVienController@edit')->name('cap-nhat');
			Route::post('/cap-nhat/{id}', 'QuanTriVienController@update')->name('xl-cap-nhat');
			Route::get('/thung-rac', 'QuanTriVienController@bin')->name('thung-rac');
			Route::get('restore/{id}','QuanTriVienController@restore')->name('restore');
			Route::get('delete/{id}','QuanTriVienController@delete')->name('delete');
		});
	});

	Route::prefix('thong-ke')->group(function(){
		Route::name('thong-ke.')->group(function(){
			Route::get('/thong-ke-doanh-thu','MuaCreditController@ThongKeDoanhThu')->name('thong-ke-doanh-thu');
			Route::get('/thong-ke-nguoi-mua-credit','MuaCreditController@ThongkeNguoiMuaCredit')->name('thong-ke-nguoi-mua-credit');
			//Route::get('/','ThongKeController@destroy')->name('xoa');
			//Route::get('/them-moi', 'ThongKeController@create')->name('them-moi');
		});
	});
});

Route::get('public/{filename}', function ($filename)
{
    return Image::make(storage_path('public/' . $filename))->response();
});