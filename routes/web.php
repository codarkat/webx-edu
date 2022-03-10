<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
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

//Route::get('/', function () {
//    return view('welcome');
//})->name('user.home');



Route::post(
    '/update',
    [ResultController::class, 'update']
)->name('result.update');


Route::prefix('result')->name('result.')->group(function () {
    Route::post(
        '/store',
        [ResultController::class, 'store']
    )->name('store');
    Route::post(
        '/update',
        [ResultController::class, 'update']
    )->name('update');
    Route::post(
        '/check',
        [ResultController::class, 'check']
    )->name('check');

    Route::post(
        '/get-result',
        [ResultController::class, 'getResult']
    )->name('get-result');
});

//Topic
Route::prefix('topic')->name('topic.')->group(function () {
    Route::post(
        '/store',
        [TopicController::class, 'store']
    )->name('store');
    Route::post(
        '/update',
        [TopicController::class, 'update']
    )->name('update');
    Route::post(
        '/delete',
        [TopicController::class, 'delete']
    )->name('delete');

    Route::get(
        '/get-topic/{id}',
        [TopicController::class, 'getTopic']
    )->name('get-topic');

    Route::get(
        '/get-topic-details/{id}',
        [TopicController::class, 'getTopicDetails']
    )->name('get-topic-details');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get(
        'dashboard',
        [AdminController::class, 'dashboard']
    )->name('dashboard');

    Route::get(
        '/topic-details/topic-id-{id}',
        [AdminController::class, 'topicDetails']
    )->name('topic-details');
});

//Route::prefix('user')->name('user.')->group(function () {
//    Route::get(
//        '/exam/exam-id-{id}',
//        [UserController::class, 'exam']
//    )->name('exam');
//
//    Route::get(
//        '/topics',
//        [UserController::class, 'topics']
//    )->name('topics');
//});


Route::prefix('question')->name('question.')->group(function () {
    Route::post(
        '/store',
        [QuestionController::class, 'store']
    )->name('store');

    Route::post(
        '/update',
        [QuestionController::class, 'update']
    )->name('update');

    Route::post(
        '/delete',
        [QuestionController::class, 'delete']
    )->name('delete');
    Route::get(
        '/get-question/{id}',
        [QuestionController::class, 'getQuestion']
    )->name('get-question');
});

Route::prefix('subscribe')->name('subscribe.')->group(function () {
    Route::post(
        '/store',
        [SubscribeController::class, 'store']
    )->name('store');

    Route::post(
        '/delete',
        [SubscribeController::class, 'delete']
    )->name('delete');
});


Auth::routes();
//Disable register, reset password
Route::match(['get', 'post'], 'register', function(){
    return route('index');
});
Route::match(['get', 'post'], 'password/reset', function(){
    return route('index');
});


Route::get('/', function () {
    return view('main.index');
})->name('index')->middleware(['guest:web']);

Route::prefix('user')->name('user.')->group(function (){
    Route::middleware(['guest:web'])->group(function (){
        Route::post('/check', [
            'as' => 'check',
            'uses' => 'User\UserController@check'
        ]);
    });

    Route::middleware(['auth:web'])->group(function (){
        Route::get(
            '/exam/exam-id-{id}',
            [UserController::class, 'exam']
        )->name('exam');

        Route::get(
            '/result/exam-id-{id}',
            [UserController::class, 'result']
        )->name('result');

        Route::get(
            '/topics',
            [UserController::class, 'topics']
        )->name('topics');
    });
});
