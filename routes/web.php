<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Homework;
use App\Info;

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
Route::get('/detail/{id}', 'InfoController@infodetail')->name('detail');

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
    Route::any('manage/student/search', 'StudentController@search')->name('student.search');
    Route::any('manage/upload/search', 'UploadController@search')->name('upload.search');
    //上傳
    Route::any('manage/student/import', function () {return view('manage.student.import');});
    Route::any('manage/student/upload', 'StudentController@import')->name('student.import');
    Route::post('homework/{id}/{student_id}', 'UploadController@upload')->name('homework.upload');
});

// Manage
Route::prefix('manage')->middleware('auth')->group(function(){
    Route::resource('member', 'MemberController');
    Route::resource('config', 'ConfigController');
    Route::resource('notice', 'NoticeController');
    Route::resource('log', 'LogController');
    Route::resource('info', 'InfoController');
    Route::resource('course', 'CourseController');
    Route::resource('student', 'StudentController');
    Route::resource('homework', 'HomeworkController');
    Route::resource('upload', 'UploadController');
});

//在各視圖中可直接使用以下參數
View::composer(['*'], function ($view) {
    $config = DB::table('configs')->where('id','1')->first();
    Config::set('app.name', $config->app_name);
    $infos = Info::where('is_sticky',0)->where('is_open',1)->orderby('updated_at')->paginate(10);
    $info_stickys = Info::where('is_sticky',1)->where('is_open',1)->orderby('sort')->get();

    $view->with('config',$config);
    $view->with('infos',$infos);
    $view->with('info_stickys',$info_stickys);
});
