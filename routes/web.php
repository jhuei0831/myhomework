<?php

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
    return view('index');
});

Auth::routes();

Route::get('/manage', function () {return view('manage.index');})->middleware('auth')->name('manage');

Route::get('/home', 'HomeController@index')->name('home');

//中介層:登入/非IE瀏覽器/信箱驗證/管理員
Route::middleware('auth')->group(function() {
    //排序
    Route::post('info-sortable','InfoController@sort')->name('info.sort');
    Route::get('/manage/info/sort', function () {return view('manage.info.sort');});
    //刪除背景
    Route::get('/manage/config/delete_background/{id}', 'ConfigController@delete_background')->name('config.delete_background');
    //搜尋
    Route::any('manage/log/search', 'LogController@search')->name('log.search');
    Route::any('manage/member/search', 'MemberController@search')->name('member.search');
});

// Manage
Route::prefix('manage')->middleware('auth')->group(function(){
    Route::resource('member', 'MemberController');
    Route::resource('config', 'ConfigController');
    Route::resource('notice', 'NoticeController');
    Route::resource('log', 'LogController');
    Route::resource('info', 'InfoController');
});
