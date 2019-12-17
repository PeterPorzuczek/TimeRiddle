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
Route::get('/board/{courseName}/{coursePassword}', 'LearnController@showBoard');

Route::get('/learn/{courseName}/{coursePassword}', 'LearnController@learn');

Route::prefix('t')->group(function () {

    Route::prefix('management')->group(function () {

        Auth::routes();

        Route::get('/courses', 'ManageController@index');

        Route::get('/photos', 'PhotoController@index');

        Route::resource('photos', 'PhotoController');

        Route::get('/quests/filter/{courseId?}/{topicId?}', 'QuestController@index')->name('quests.topics.filter');

        Route::get('/quests/filter/{courseId?}', 'QuestController@index')->name('quests.filter');

        Route::get('/quests', 'QuestController@index');

        Route::resource('quests', 'QuestController');

        Route::get('/topics/filter/{courseId?}', 'TopicController@index')->name('topics.filter');

        Route::get('/topics', 'TopicController@index');

        Route::resource('topics', 'TopicController');

        Route::get('/courses', 'CourseController@index');

        Route::resource('courses', 'CourseController');

    });

});
