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

Route::get('/', function () {
    return view('home');
});
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(array('prefix' => 'admin', 'namespace' => 'Admin'), function() {
        Route::get('/', 'AdminPanelController@index')->name('admin');
        Route::get('/users', 'AdminUsersController@index')->name('admin_users');
        Route::get('/subjects', 'AdminSubjectsController@index')->name('admin_subjects');
        Route::get('/rooms', 'AdminRoomsController@index')->name('admin_rooms');
        Route::get('/classes', 'AdminClassesController@index')->name('admin_classes');
        Route::get('/attendances', 'AdminAttendancesController@index')->name('admin_attendances');
        Route::get('/test', 'AdminPanelController@test_connection')->name('admin_test_connection');

        Route::group(array('prefix' => 'add'), function() {
            Route::post('/user', 'AdminUsersController@add_user')->name('admin_add_user');
            Route::post('/subject', 'AdminSubjectsController@add_subject')->name('admin_add_subject');
            Route::post('/room', 'AdminRoomsController@add_room')->name('admin_add_room');
            Route::post('/classes', 'AdminClassesController@add_classes')->name('admin_add_classes');
            Route::post('/attendance', 'AdminAttendancesController@add_attendance')->name('admin_add_attendance');
        });
        Route::group(array('prefix' => 'delete'), function() {
            Route::get('/user/{user_id}', 'AdminUsersController@delete_user')->name('admin_delete_user');
            Route::get('/subject/{subject_id}', 'AdminSubjectsController@delete_subject')->name('admin_delete_subject');
            Route::get('/room/{room_id}', 'AdminRoomsController@delete_room')->name('admin_delete_room');
            Route::get('/classes/{classes_id}', 'AdminClassesController@delete_classes')->name('admin_delete_classes');
            Route::get('/attendance/{attendance_id}', 'AdminAttendancesController@delete_attendance')->name('admin_delete_attendance');
        });
        Route::group(array('prefix' => 'edit'), function() {
            Route::get('/user/{user_id}', 'AdminUsersController@edit_user')->name('admin_edit_user');
            Route::get('/subject/{subject_id}', 'AdminSubjectsController@edit_subject')->name('admin_edit_subject');
            Route::get('/room/{room_id}', 'AdminRoomsController@edit_room')->name('admin_edit_room');
            Route::get('/classes/{classes_id}', 'AdminClassesController@edit_classes')->name('admin_edit_classes');
            Route::get('/attendance/{attendance_id}', 'AdminAttendancesController@edit_attendance')->name('admin_edit_attendance');
        });
    });

    Route::group(array('prefix' => 'user', 'namespace' => 'User'), function() { //TODO poprawic {user_id}
        Route::get('/subjects/{groupBy?}', 'UserSubjectsController@index')->name('user_subjects');
        Route::get('/classes/{groupBy?}', 'UserClassesController@index')->name('user_classes');
        Route::get('/attendance/{groupBy?}', 'UserAttendancesController@index')->name('user_attendances');

        Route::get('/classes/start/{classes_id}', 'UserClassesController@start_classes')->name('user_start_classes');
        Route::post('/classes/start', 'UserClassesController@start_classes_verified')->name('user_start_classes_verified')->middleware('classesCode');
        Route::post('/classes/save', 'UserClassesController@save_classes_data')->name('user_save_classes_data');
        Route::get('/classes/preview/{classes_id}/{orderBy?}/{orderDirection?}', 'UserClassesController@preview_classes')->name('user_preview_classes');

        Route::group(array('prefix' => 'add'), function() {
            Route::post('/subject', 'UserSubjectsController@add_subject')->name('user_add_subject');
            Route::post('/classes', 'UserClassesController@add_classes')->name('user_add_classes');
            Route::post('/attendance', 'UserAttendancesController@add_attendance')->name('user_add_attendance');
            Route::post('/attendance/note', 'UserAttendancesController@add_attendance_note')->name('user_add_attendance_note');
        });

        Route::group(array('prefix' => 'delete'), function() {
            Route::get('/subject/{subject_id}/{groupBy?}', 'UserSubjectsController@delete_subject')->name('user_delete_subject');
            Route::get('/classes/{classes_id}/{groupBy?}', 'UserClassesController@delete_classes')->name('user_delete_classes');
            Route::get('/attendance/{attendance_id}/{groupBy?}', 'UserAttendancesController@delete_attendance')->name('user_delete_attendance');
        });

        Route::group(array('prefix' => 'edit'), function() {
            Route::post('/subject', 'UserSubjectsController@edit_subject')->name('user_edit_subject');
//            Route::get('/attendance/{attendance_id}/{groupBy?}', 'UserAttendancesController@edit_attendance')->name('user_edit_attendance');
        });

        Route::get('/export/attendances/{classes_id}', 'UserAttendancesController@export')->name('user_export');
        Route::get('/export/attendances/grouped/{groupBy}', 'UserAttendancesController@export_grouped')->name('user_export_grouped');
    });
});

