<?php

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

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('adminlogin');
Route::get('/user/login', [App\Http\Controllers\Auth\LoginController::class, 'userLogin'])->name('userLogin');
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLoginAction'])->name('AdminLoginAction');
Route::post('/user/login', [App\Http\Controllers\Auth\LoginController::class, 'userLoginAction'])->name('UserLoginAction');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('adminHome');
Route::post('/admin', [App\Http\Controllers\Auth\LoginController::class, 'admin_logout'])->name('admin_logout');
Route::post('/user', [App\Http\Controllers\Auth\LoginController::class, 'user_logout'])->name('user_logout');
Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'adminprofile'])->name('adminprofile');
Route::post('/profile', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('updateProfile');
Route::get('admin/resetpwd', [App\Http\Controllers\Admin\AdminController::class, 'ResetPassword'])->name('ResetPassword');
Route::post('admin/resetpwd', [App\Http\Controllers\Admin\AdminController::class, 'UpdatePwd'])->name('UpdatePwd');
Route::get('admin/CreateAdmin', [App\Http\Controllers\Admin\AdminController::class, 'CreateAdminUser'])->name('CreateAdminUser');
Route::post('admin/CreateAdmin', [App\Http\Controllers\Admin\AdminController::class, 'InsertAdminUser'])->name('InsertAdminUser');
Route::get('admin/ViewAdmin', [App\Http\Controllers\Admin\AdminController::class, 'ViewAdmin'])->name('ViewAdmin');
Route::get('admin/EditAdmin/{id}', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('EditAdmin');
Route::post('admin/EditAdmin/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('update');
Route::delete('admin/ViewAdmin/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete'])->name('delete');
Route::get('admin/CreateCategory', [App\Http\Controllers\Admin\AdminController::class, 'CreateCategory'])->name('CreateCategory');
Route::post('admin/CreateCategory', [App\Http\Controllers\Admin\AdminController::class, 'InsertCategory'])->name('InsertCategory');
Route::get('admin/ViewCategory', [App\Http\Controllers\Admin\AdminController::class, 'ViewCategory'])->name('ViewCategory');
Route::get('/admin/EditCategory/{id}', [App\Http\Controllers\Admin\AdminController::class, 'EditCategory'])->name('EditCategory');
Route::PUT('/admin/EditCategory/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updatecategory'])->name('updatecategory');
Route::DELETE('/admin/ViewCategory/{id}', [App\Http\Controllers\Admin\AdminController::class, 'deletecategory'])->name('deletecategory');
Route::get('admin/CreateTestimonial', [App\Http\Controllers\Admin\AdminController::class, 'CreateTestimonial'])->name('CreateTestimonial');
Route::post('admin/CreateTestimonial', [App\Http\Controllers\Admin\AdminController::class, 'InsertTestimonial'])->name('InsertTestimonial');
Route::get('admin/ViewTestimonial', [App\Http\Controllers\Admin\AdminController::class, 'ViewTestimonial'])->name('ViewTestimonial');
Route::get('/admin/EditTestimonial/{id}', [App\Http\Controllers\Admin\AdminController::class, 'EditTestimonial'])->name('EditTestimonial');
Route::PUT('admin/EditTestimonial/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updatetestimonial'])->name('updatetestimonial');
Route::DELETE('/admin/ViewTestimonial/{id}', [App\Http\Controllers\Admin\AdminController::class, 'deletetestimonial'])->name('deletetestimonial');
Route::get('admin/SalonInfo', [App\Http\Controllers\Admin\AdminController::class, 'SalonInfo'])->name('SalonInfo');
Route::post('admin/SalonInfo', [App\Http\Controllers\Admin\AdminController::class, 'InsertSalonInfo'])->name('InsertSalonInfo');
Route::get('admin/CreateTeam', [App\Http\Controllers\Admin\AdminController::class, 'CreateTeam'])->name('CreateTeam');
Route::post('admin/CreateTeam', [App\Http\Controllers\Admin\AdminController::class, 'InsertTeam'])->name('InsertTeam');
Route::get('admin/ViewTeam', [App\Http\Controllers\Admin\AdminController::class, 'ViewTeam'])->name('ViewTeam');
Route::DELETE('/admin/ViewTeam/{id}', [App\Http\Controllers\Admin\AdminController::class, 'deleteteam'])->name('deleteteam');
Route::get('/admin/EditTeam/{id}', [App\Http\Controllers\Admin\AdminController::class, 'EditTeam'])->name('EditTeam');
Route::PUT('admin/EditTeam/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateteam'])->name('updateteam');

