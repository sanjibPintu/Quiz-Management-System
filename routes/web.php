<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashbord;
use  App\Http\Controllers\UserDashbordController;
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


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('dashbord');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');




Route::post('home/add_catagory', [AdminDashbord::class,'addCatagory'])->name('add_catagory')->middleware('is_admin');

Route::post('home/add_qustion', [AdminDashbord::class,'addTheQustion'])->name('addQustion')->middleware('is_admin');

Route::get('/participate/quiz/{catagory}', [UserDashbordController::class,'qustion'])->name('quizParticipation');

Route::get('ansersaved/', [UserDashbordController::class,'answeredSave']);
// Route::post('ansersaved/', [UserDashbordController::class,'answeredSave']);
Route::post('ansersaved/', [UserDashbordController::class,'getingdata']);
// Route::post('ansersaved',[UserDashbordController::class,'getingdata']);
Route::get('studentresult/{id}', [AdminDashbord::class,'ShowingStudentResult']);
Route::post('showallstudentdetails/', [AdminDashbord::class,'showallStudentdetails']);