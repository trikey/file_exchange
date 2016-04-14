<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', function() { return redirect('/'); });
    Route::get('/', 'IndexController@index');


    Route::get('users', ['as' => 'admin_users', 'uses' => 'UsersController@index']);
    Route::delete('users/{id}', ['as' => 'admin_users_delete', 'uses' => 'UsersController@destroy']);
    Route::get('users/create', ['as' => 'admin_users_create', 'uses' => 'UsersController@create']);
    Route::post('users/create', ['as' => 'admin_users_store', 'uses' => 'UsersController@storeUser']);
    Route::get('users/{id}/edit', ['as' => 'admin_users_edit', 'uses' => 'UsersController@editUser']);
    Route::put('users/{id}/edit', ['as' => 'admin_users_update', 'uses' => 'UsersController@updateUser']);


    Route::get('folders', ['as' => 'admin_folders', 'uses' => 'FoldersController@index']);
    Route::delete('folders/{id}', ['as' => 'admin_folders_delete', 'uses' => 'FoldersController@destroy']);
    Route::get('folders/create', ['as' => 'admin_folders_create', 'uses' => 'FoldersController@create']);
    Route::get('folders/gettree', ['as' => 'get_folders_tree', 'uses' => 'FoldersController@getTree']);
    Route::post('folders/create', ['as' => 'admin_folders_store', 'uses' => 'FoldersController@store']);
    Route::get('folders/{id}/edit', ['as' => 'admin_folders_edit', 'uses' => 'FoldersController@edit']);
    Route::put('folders/{id}/edit', ['as' => 'admin_folders_update', 'uses' => 'FoldersController@update']);
    Route::get('folders/{id}', ['as' => 'admin_folder_view', 'uses' => 'FoldersController@viewFolder']);


//    Route::get('files', ['as' => 'admin_files', 'uses' => 'FilesController@index']);
    Route::get('files/getmodal', ['as' => 'admin_files_get_modal', 'uses' => 'FilesController@getModal']);
//    Route::get('files/multi', ['as' => 'admin_files_multi', 'uses' => 'FilesController@multi']);
    Route::post('files/multi', ['as' => 'admin_files_multi_post', 'uses' => 'FilesController@multiHandle']);
    Route::delete('files/{id}', ['as' => 'admin_files_delete', 'uses' => 'FilesController@destroy']);
//    Route::get('files/create', ['as' => 'admin_files_create', 'uses' => 'FilesController@create']);
    Route::post('files/create', ['as' => 'admin_files_store', 'uses' => 'FilesController@store']);
//    Route::get('files/{id}/edit', ['as' => 'admin_files_edit', 'uses' => 'FilesController@edit']);
    Route::put('files/{id}/edit', ['as' => 'admin_files_update', 'uses' => 'FilesController@update']);
    Route::get('files/{id}', ['as' => 'admin_files_download', 'uses' => 'FilesController@download']);

    Route::get('search', ['as' => 'search', 'uses' => 'FoldersController@search']);
    Route::get('users/search', ['as' => 'users_search', 'uses' => 'UsersController@search']);
});