<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SubAdminController;
use App\Http\Controllers\SuperAdminController;

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

Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::get('/login',function(){
    return redirect('/');
});

Route::get('/login',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout']);

Route::group(['prefix' => 'super-admin','middleware'=>['web','isSuperAdmin']],function(){
    Route::get('/dashboard',[SuperAdminController::class,'dashboard']);

    Route::get('/users',[SuperAdminController::class,'users'])->name('superAdminUsers');
    Route::get('/manage-role',[SuperAdminController::class,'manageRole'])->name('manageRole');
    Route::post('/update-role',[SuperAdminController::class,'updateRole'])->name('updateRole');
    Route::delete('/delete-user',[UserController::class,'destroy'])->name('superadmin.destroy');

    Route::get('/dashboard',[UserController::class,'dashboard']);
    Route::delete('/delete-post', PostController::class . '@destroy')->name('posts.destroy');

    Route::get('/', SuperAdminController::class .'@index')->name('super-admin.index');
    // Route::delete('/posts/{post}', PostController::class .'@destroy')->name('posts.destroy');
});

Route::group(['prefix' => 'sub-admin','middleware'=>['web','isSubAdmin']],function(){
    Route::get('/dashboard',[SubAdminController::class,'dashboard']);
    Route::get('/', PostController::class .'@index')->name('posts.index');
});

Route::group(['prefix' => 'admin','middleware'=>['web','isAdmin']],function(){
    Route::get('/dashboard',[AdminController::class,'dashboard']);
    
});

Route::group(['middleware'=>['auth']],function(){

    Route::post('/change_role', UserController::class .'@change_role')->name('users.change_role');

    Route::post('/change_status', PostController::class .'@change_status')->name('posts.change_status');
    Route::post('/change_department', UserController::class .'@change_department')->name('users.change_department');
    

    Route::get('/user/dashboard',[UserController::class,'dashboard']);
    Route::get('/index', PostController::class .'@index')->name('posts.index');
    Route::get('/posts/create', PostController::class . '@create')->name('posts.create');
    Route::post('/posts', [App\Http\Controllers\PostController::class,'store'])->name('posts.store');
    Route::get('/posts/{post}', PostController::class .'@show')->name('posts.show');
    Route::get('/posts/{post}/edit', PostController::class .'@edit')->name('posts.edit');
    Route::put('/posts/{post}', PostController::class .'@update')->name('posts.update');

});

        Route::get('/departments', DepartmentController::class .'@index')->name('departments.index');
        Route::get('/departments/create', DepartmentController::class . '@create')->name('departments.create');
        Route::post('/departments', [App\Http\Controllers\DepartmentController::class,'store'])->name('departments.store');
        Route::get('/departments/{department}', DepartmentController::class .'@show')->name('departments.show');
        Route::get('/departments/{department}/edit', DepartmentController::class .'@edit')->name('departments.edit');
        Route::put('/departments/{department}', DepartmentController::class .'@update')->name('departments.update');
        Route::delete('/delete-department', DepartmentController::class . '@destroy')->name('departments.destroy');
