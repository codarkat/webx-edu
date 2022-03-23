<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\LoginController;
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

    Route::get(
        '/get-all',
        [ResultController::class, 'getAll']
    )->name('get-all');

    Route::get(
        '/get-user-results/{user_id}',
        [ResultController::class, 'getUserResults']
    )->name('get-user-results');

    Route::get(
        '/get-clock/{topic_id}',
        [ResultController::class, 'getClock']
    )->name('get-clock');
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

    Route::get(
        '/get-active-topics',
        [TopicController::class, 'getActiveTopics']
    )->name('get-active-topics');
});





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

    Route::middleware(['auth:web', 'PreventBrowserBackHistory'])->group(function (){
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

        Route::get('/list-results',
            [UserController::class, 'listResults']
        )->name('list-results');
    });
});

Route::controller(SubscribeController::class)->middleware(['auth:web'])->group(function (){
    Route::prefix('subscribe')->name('subscribe.')->group(function () {
        Route::post( '/store','store')->name('store');
        Route::post( '/delete', 'delete')->name('delete');
    });
});


Route::prefix('admin')->name('admin.')->group(function (){
    Route::middleware(['auth:admin', 'PreventBrowserBackHistory'])->group(function (){
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/topic-details/topic-id-{id}', [AdminController::class, 'topicDetails'])->name('topic-details');
        Route::get('/list-results', [AdminController::class, 'listResults'])->name('list-results');
        Route::get('/result/{user_id}/{topic_id}', [AdminController::class, 'result'])->name('result');
    });

    Route::middleware(['guest:admin', 'PreventBrowserBackHistory'])->group(function (){
        Route::get('/',  [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('check');
    });
});
