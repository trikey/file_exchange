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
    Route::get('/index', 'IndexController@main');


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
    Route::get('folders/getmodal/{id}', ['as' => 'admin_folders_get_modal_update', 'uses' => 'FoldersController@getModalForUpdate']);
    Route::put('folders/{id}/update', ['as' => 'admin_folders_update_preview_picture', 'uses' => 'FoldersController@updatePreviewPicture']);

    Route::get('filebox', ['as' => 'filebox', 'uses' => 'FoldersController@filebox']);
    Route::post('filebox/{id}', ['as' => 'admin_add_to_file_box', 'uses' => 'FoldersController@addToFileBox']);
    Route::post('filebox/remove/{id}', ['as' => 'admin_remove_from_file_box', 'uses' => 'FoldersController@removeFromFileBox']);


    Route::get('download/{id}', ['as' => 'download_all', 'uses' => 'FoldersController@downloadAll']);
    Route::get('download_filebox', ['as' => 'download_filebox', 'uses' => 'FoldersController@downloadFileBox']);
//    Route::get('files', ['as' => 'admin_files', 'uses' => 'FilesController@index']);
    Route::get('files/getmodal', ['as' => 'admin_files_get_modal', 'uses' => 'FilesController@getModal']);
    Route::get('files/getmodal/{id}', ['as' => 'admin_files_get_modal_update', 'uses' => 'FilesController@getModalForUpdate']);
//    Route::get('files/multi', ['as' => 'admin_files_multi', 'uses' => 'FilesController@multi']);
    Route::get('files/multi', ['as' => 'admin_files_multi', 'uses' => 'FilesController@multiView']);
    Route::post('files/multi', ['as' => 'admin_files_multi_post', 'uses' => 'FilesController@multiHandle']);
    Route::delete('files/{id}', ['as' => 'admin_files_delete', 'uses' => 'FilesController@destroy']);
//    Route::get('files/create', ['as' => 'admin_files_create', 'uses' => 'FilesController@create']);
    Route::post('files/create', ['as' => 'admin_files_store', 'uses' => 'FilesController@store']);
//    Route::get('files/{id}/edit', ['as' => 'admin_files_edit', 'uses' => 'FilesController@edit']);
    Route::put('files/{id}/edit', ['as' => 'admin_files_update', 'uses' => 'FilesController@update']);
    Route::get('files/{id}', ['as' => 'admin_files_download', 'uses' => 'FilesController@download']);
    Route::get('files/info/{id}', ['as' => 'admin_files_get_info', 'uses' => 'FilesController@getInfo']);

    Route::get('search', ['as' => 'search', 'uses' => 'FoldersController@search']);
    Route::get('users/search', ['as' => 'users_search', 'uses' => 'UsersController@search']);
    Route::get('users/pending', ['as' => 'admin_users_unconfirmed', 'uses' => 'UsersController@pendingConfirmation']);
    Route::put('users/confirm/{id}', ['as' => 'admin_users_confirm', 'uses' => 'UsersController@confirm']);

    Route::get('testemail', function() {
        $user = \App\User::find(3);
        $res = Mail::send('emails.registered', ['user' => $user], function ($m) use ($user) {
            $m->from('media@redmond.company', 'media@redmond.company');
            $m->to('belitskii@gmail.com', $user->fio)->subject(trans('users.new_user_registered'));
        });
        dd($res);
    });
});