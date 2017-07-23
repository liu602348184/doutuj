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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
	Route::get('/backend122', 'BackendController@index')->name('backend');
	Route::post('/backend122/inserttplface', 'BackendController@insert_tplface');
	Route::delete('/backend122/deletetplface', 'BackendController@delete_tplface');

	Route::get('/backend122/navbar', 'BackendController@navbar')->name('navbar');
	Route::post('/backend122/navbar/create', 'BackendController@create_navbar');
	Route::delete('/backend122/navbar/delete', 'BackendController@delete_navbar');

	Route::get('/backend122/face/{id}', 'BackendController@face')->name('face');
	Route::post('/backend122/face/{id}/create', 'BackendController@create_face')->name('face');
	Route::delete('/backend122/face/delete', 'BackendController@delete_face');

	Route::get('/backend122/article', 'BackendController@article')->name('article');
	Route::post('/backend122/article/create', 'BackendController@create_article');
	Route::delete('/backend122/article/delete', 'BackendController@delete_article');
});

// Route::get('/backend122', function(){
// 	// Auth::routes();
// 	// return redirect()->route('login');
// });
// Auth::routes();
Route::get('/', 'CreateController@index')->name('home');
Route::get('/article', 'ArticleController@index');
Route::get('/article/{id}.html', 'ArticleController@detail');
Route::post('/article/thumbs_up', 'ArticleController@thumbs_up');
// Route::get('/article/download/{id}.zip');
// Route::get('/image/tplface/{id}.jpg', 'StorageController@tplface');
// Route::get('/image/createface/{id}.jpg', 'StorageController@createface');
// Route::get('/image/face/{id}.jpg', 'StorageController@face');
Route::get('/face/{navid}', 'FaceController@facelist');
Route::get('/createface/download/{id}.jpg', 'CreateController@download');
Route::post('/templateface/create', 'CreateController@createface');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
