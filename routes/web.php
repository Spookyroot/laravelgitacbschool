<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use RealRashid\SweetAlert\Facades\Alert;

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
/*
Route::get('/subject',[subjectController::class,'list']);
*/

/*Route::get('/credit', function(){
    return view('credit.credits');
});*/
Route::get('/home', function(){
    return view('homepage.home');
});


//course
Route::get('/course',[CourseController::class, 'list'])->name('course.list');
Route::get('/course-view/{course}',[CourseController::class, 'show'])->name('course.view');
Route::get('/course/create',[CourseController::class, 'createForm'])->name('course.create-form');
Route::post('/course/create',[CourseController::class, 'create'])->name('course.create');
Route::get('/course/{course}/update',[CourseController::class, 'updateForm'])->name('course.update-form');
Route::post('/course/{course}/update',[CourseController::class, 'update'])->name('course.update');
Route::get('/course/{course}/delete',[CourseController::class, 'delete'])->name('course.delete');

//subject
Route::get('/subject',[SubjectController::class, 'list'])->name('subject.list');
Route::get('/subject-view/{subject}',[SubjectController::class, 'show'])->name('subject.view');
Route::get('/subject/create',[SubjectController::class, 'createForm'])->name('subject.create-form');
Route::post('/subject/create',[SubjectController::class, 'create'])->name('subject.create');
Route::get('/subject/{subject}/update',[SubjectController::class, 'updateForm'])->name('subject.update-form');
Route::post('/subject/{subject}/update',[SubjectController::class, 'update'])->name('subject.update');
Route::get('/subject/{subject}/delete',[SubjectController::class, 'delete'])->name('subject.delete');

//teacher
Route::get('/teacher',[TeacherController::class, 'list'])->name('teacher.list');
Route::get('/teacher-view/{teacher}',[TeacherController::class, 'show'])->name('teacher.view');
Route::get('/teacher/create',[TeacherController::class, 'createForm'])->name('teacher.create-form');
Route::post('/teacher/create',[TeacherController::class, 'create'])->name('teacher.create');
Route::get('/teacher/{teacher}/update',[TeacherController::class, 'updateForm'])->name('teacher.update-form');
Route::post('/teacher/{teacher}/update',[TeacherController::class, 'update'])->name('teacher.update');
Route::get('/teacher/{teacher}/delete',[TeacherController::class, 'delete'])->name('teacher.delete');

//login

Route::get('/auth/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout');

//user
Route::get('/user', [UserController::class, 'list'])->name('user.list');
Route::get('/user/create',[UserController::class, 'createForm'])->name('user.create-form');
Route::post('/user/create',[UserController::class, 'create'])->name('user.create');
Route::get('/user/{user}',[UserController::class, 'show'])->name('user.view');
Route::get('/user/{user}/update',[UserController::class, 'updateForm'])->name('user.update-form');
Route::post('/user/{user}/update',[UserController::class, 'update'])->name('user.update');
Route::get('/user/{user}/delete',[UserController::class, 'delete'])->name('user.delete');