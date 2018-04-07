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
//frontend
Route::get('/', 'frontend\ImageController@index');
Route::get('/{id}', 'frontend\ImageController@show')->name('post')->middleware('filter');
Route::get('/the-loai/{id}', 'frontend\ImageController@type')->name('type');
Route::get('/quoc-gia/{id}', 'frontend\ImageController@region')->name('region');
Route::get('/chau-luc/{id}', 'frontend\ImageController@continent')->name('continent');
Route::get('/tag/{id}', 'frontend\ImageController@tag')->name('tag');
Route::get('/tag/{id}/bai-viet', 'frontend\ImageController@tagPost')->name('tagPost');
Route::get('/tag/{id}/hinh-anh', 'frontend\ImageController@tagImage')->name('tagImage');
Route::get('/bai-viet/xem-them', 'frontend\ImageController@postView')->name('postView');
Route::get('hinh-anh/{id}', 'frontend\ImageController@image')->name('image')->middleware('filter');
Route::get('tim-kiem/{id}', 'SearchController@search')->name('search');
Route::get('tim-kiem/{id}/bai-viet', 'frontend\ImageController@searchPost')->name('searchPost');
Route::get('tim-kiem/{id}/hinh-anh', 'frontend\ImageController@searchImage')->name('searchImage');


//backend
Route::group(['prefix'=>'admin'], function () {
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    //change password
    Route::post('changePassword', 'Auth\ChangepasswordController@postCredentials')->name('changePassword');
    //
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::group(['prefix' => '/'], function () {
        Route::get('dashboard', 'backend\DashboardController@index')->name('dashboard');
    });

    Route::group(['prefix' => 'image'], function () {
        Route::get('/', 'backend\ImageController@index')->name('view.image');
        Route::get('create', 'backend\ImageController@create')->name('view.image.create');
        Route::post('store', 'backend\ImageController@store')->name('view.image.store');
        //delete
        Route::post('delete/{id}', 'backend\ImageController@destroy')->name('view.image.destroy');
        //edit
        Route::get('/{id}/edit', 'backend\ImageController@edit')->name('view.image.show');
        Route::post('/{id}/edit', 'backend\ImageController@update');
        //
        Route::post('loadingGroups', 'backend\ImageController@loadingGroup')->name('view.image.loadingGroups');
        Route::post('uploadAFile', 'backend\ImageController@uploadAFile')->name('view.image.uploadafile');
        Route::post('uploadFile', 'backend\ImageController@uploadFile')->name('view.image.uploadfile');
        Route::post('ajaxStatus', 'backend\ImageController@ajaxStatus')->name('view.image.ajaxStatus');
        Route::post('getUrl', 'backend\ImageController@getUrl')->name('view.image.getUrl');
        //upload serve
        Route::post('uploadFileServe', 'backend\ImageController@uploadFileServe')->name('view.image.uploadServe');
    });

    Route::group(['prefix' => 'group'], function () {
        Route::get('/', 'backend\GroupController@index')->name('view.group');
        Route::post('create', 'backend\GroupController@create')->name('view.group.create');
        //group edit
        Route::get('{id}/edit', 'backend\GroupController@edit')->name('view.group.edit');
        Route::post('{id}/edit', 'backend\GroupController@postEdit');
        //group delete
        Route::post('delete/{id}', 'backend\GroupController@delete');
        //region
        Route::post('createRegion', 'backend\GroupController@createRegion')->name('view.group.createRegion');
        //delete region
        Route::post('deleteRegion/{id}', 'backend\GroupController@deleteRegion');
        Route::get('{id}/editRegion', 'backend\GroupController@editRegion')->name('view.group.editRegion');
        Route::post('{id}/editRegion', 'backend\GroupController@postEditRegion');

        Route::post('getNameSeoGroup', 'backend\GroupController@getNameSeoGroup')->name('view.group.getNameSeoGroup');
        Route::post('getNameSeoRegion', 'backend\GroupController@getNameSeoRegion')->name('view.group.getNameSeoRegion');

        //type
        Route::post('createType', 'backend\GroupController@createType')->name('view.group.createType');
        Route::post('{id}/editType', 'backend\GroupController@editType');
        Route::get('deleteType/{id}', 'backend\GroupController@deleteType')->name('view.group.deleteType');

        //continent
        Route::post('createContinent', 'backend\GroupController@createContinent')->name('view.group.createContinent');
        Route::post('{id}/editContinent', 'backend\GroupController@editContinent');
        Route::get('deleteContinent/{id}', 'backend\GroupController@deleteContinent')->name('view.group.deleteContinent');
    });
    //tag
    Route::group(['prefix'=>'tag'], function () {
        Route::get('/', 'backend\TagController@index')->name('view.tag');
        Route::post('/', 'backend\TagController@edit')->name('view.edit');
        Route::post('create', 'backend\TagController@create')->name('view.tag.create');
    });
});

