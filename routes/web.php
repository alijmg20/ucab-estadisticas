<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CarruselController;
use App\Http\Controllers\Admin\EmailsController;
use App\Http\Controllers\Admin\FilesController;
use App\Http\Controllers\Admin\LineController;
use App\Http\Controllers\Admin\OpenaiController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\AnswerController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FileController as FrontFileController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\LineController as FrontLineController;
use App\Http\Controllers\Front\ProjectController as FrontProjectController;
use App\Http\Livewire\Graphics\GraphicController;
use App\Http\Livewire\Graphics\Pdf\Pdf;
use App\Http\Livewire\Quiz\ExportQuestions;
use App\Http\Livewire\Stadistic\Pdf\StadisticsPdf;
use App\Http\Livewire\Stadistic\StadisticController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'] )->name('home');
Route::get('/lines/{line}',[FrontLineController::class,'show'] )->name('lines.show');
Route::get('/lines',[FrontLineController::class,'index'] )->name('lines.index');
Route::get('/projects/{project}',[FrontProjectController::class,'show'] )->name('projects.show');
Route::get('/projects',[FrontProjectController::class,'index'] )->name('projects.index');
Route::get('/about',[AboutController::class,'index'] )->name('about');
Route::get('/contact',[ContactController::class,'index'] )->name('contact');
Route::get('/file/{file}',[FrontFileController::class,'show'] )->name('files.show');

Route::get('/quiz/answer/{quiz}',[AnswerController::class,'answer'] )->name('answer.index');
Route::get('/quiz/answer/{quiz}/answered',[AnswerController::class,'answered'] )->name('answer.answered');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    Route::get('/admin', [AdminController::class,'index'])
    ->middleware('can:admin.home')
    ->name('admin.home');

    Route::get('/admin/lines', [LineController::class,'index'])
    ->middleware('can:admin.lines.index')
    ->name('admin.lines.index');

    Route::get('/admin/users', [UserController::class,'index'])
    ->middleware('can:admin.users.index')
    ->name('admin.users.index');

    Route::get('/admin/roles', [AdminRoleController::class,'index'])
    ->middleware('can:admin.roles.index')    
    ->name('admin.roles.index');

    Route::get('/admin/carrusel', [CarruselController::class,'index'])
    ->middleware('can:admin.modules.index')        
    ->name('admin.carrusel.index');

    Route::get('/admin/testimonials', [TestimonialsController::class,'index'])
    ->middleware('can:admin.testimonials.index')            
    ->name('admin.testimonials.index');

    Route::get('/admin/emails', [EmailsController::class,'index'])
    ->middleware('can:admin.emails.index')            
    ->name('admin.emails.index');

    Route::get('/admin/files/{project}', [FilesController::class,'show'])
    ->name('admin.files.show');

    Route::get('/admin/showfile/{file}', [FilesController::class,'showfile'])
    ->name('admin.files.showfile');

    Route::get('/admin/projects', [ProjectController::class,'index'])
    ->name('admin.projects.index');

    Route::get('/admin/quiz/{quiz}', [QuizController::class,'edit'])
    ->name('admin.quiz.edit');

    Route::get('/admin/openai', [OpenaiController::class,'index'])
    ->name('admin.openai.index');

    Route::get('/export/excel/{quiz}', [ExportQuestions::class, 'downloadQuestions'])
    ->name('export.excel');

    Route::get('/pdf/{file}', Pdf::class)
    ->name('admin.pdf.graphics');

    Route::get('/admin/stadistics', StadisticController::class)
    ->name('admin.stadistics');

    Route::get('/admin/stadistics/pdf/{date_ini}/{date_end}/{line_id}', StadisticsPdf::class)
    ->name('admin.stadistics.pdf');

});