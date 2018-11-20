<?php

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
use Rap2hpoutre\FastExcel\FastExcel;
use App\StudentAccount;

Route::get('/','LoginController@index');
Route::get('/login','LoginController@index');

Route::get('logout','LoginController@logout');

Route::post('/login','LoginController@authLogin')->name('login');
// Student
Route::group(['prefix'=>'sinh-vien','middleware'=>'student'],function(){
  Route::get('/','StudentLayoutController@index')->name('studentHome');
  Route::get('me','StudentLayoutController@me');

  Route::get('khao-sat/{id}','StudentLayoutController@survey');
  Route::post('khao-sat','StudentLayoutController@submitSurvey')->name('submitSurvey');

  Route::get('change','StudentLayoutController@changePass');
  Route::post('change','StudentLayoutController@postChangePass')->name('changePass');
});
// Teacher
Route::group(['prefix'=>'giang-vien','middleware'=>'teacher'],function(){
  Route::get('/','TeacherLayoutController@index')->name('teacherHome');
  Route::get('me','TeacherLayoutController@me');

  Route::get('khao-sat/{id}','TeacherLayoutController@courseInfo');
  Route::get('khao-sat/danh-sach/{id}','TeacherLayoutController@courseStudents');

  Route::get('change','StudentLayoutController@changePass');
  Route::post('change','StudentLayoutController@postChangePass')->name('changePass');
});
// Admin
Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
  Route::get('/', 'HomeController@index')->name('home');

  // Giang-vien
  Route::group(['prefix'=>'giang-vien'],function(){
    Route::post('import','TeacherController@import')->name('importTeachers');
  });
  Route::resource('giang-vien','TeacherController');


  // Sinh vien
    Route::group(['prefix'=>'sinh-vien'],function(){
      Route::get('danh-sach','StudentController@list');
      Route::post('import','StudentController@import')->name('importStudents');
    });
    Route::resource('sinh-vien','StudentController');

    // Thong ke cuoc khao sat
    Route::group(['prefix'=>'khao-sat'],function(){
      Route::get('thong-ke','CourseController@list');
      Route::get('thong-ke/{id}','CourseController@courseInfo');
    });
  // Khao sat
  Route::get('khao-sat/default/{id}','SurveyController@changeDefault');
  Route::resource('khao-sat','SurveyController');

  // Lop mon hoc
  Route::group(['prefix'=>'mon-hoc'],function(){
    Route::post('import','CourseController@import')->name('importCourse');
  });
  Route::resource('mon-hoc','CourseController');

});
