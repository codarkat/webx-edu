<?php
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/questions',
    [QuestionController::class, 'getQuestions']
)->name('question.all');

Route::post(
    '/result-create',
    [ResultController::class, 'createResult']
)->name('result.create');


Route::post(
    '/question-create',
    [QuestionController::class, 'createQuestion']
)->name('question.create');

Route::post(
    '/question-update',
    [QuestionController::class, 'updateQuestion']
)->name('question.update');

Route::get(
    '/admin_questions',
    [QuestionController::class, 'adminGetQuestions']
)->name('question.admin_all');

Route::get(
    '/ajax-get-list-questions',
    [QuestionController::class, 'ajaxGetListQuestions']
)->name('question.ajax-get-list-questions');

Route::get(
    '/ajax-get-question/{id}',
    [QuestionController::class, 'ajaxGetQuestion']
)->name('question.ajax-get-question');

Route::post(
    '/ajax-delete-question',
    [QuestionController::class, 'deleteQuestion']
)->name('question.ajax-delete-question');
