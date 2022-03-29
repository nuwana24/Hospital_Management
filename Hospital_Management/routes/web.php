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

// Route::get('/', function () {
//     return view('welcome');
// });

//routes related Authentication
Auth::routes();

//returning to the dasshbaord homepage after suucessful authentication
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//routes related to User
Route::post('/createUser',[App\Http\Controllers\UserController::class,'createUser'])->name('createUser')->middleware('permission:create user');
Route::get('/getRegisterdUsers',[App\Http\Controllers\UserController::class,'getUsers'])->name('getRegisterdUsers');
Route::get('/editUser/{id}',[App\Http\Controllers\UserController::class,'editUser'])->name('editUser')->middleware('permission:update user');
Route::put('/updateUser/{id}',[App\Http\Controllers\UserController::class,'updateUser'])->name('updateUser')->middleware('permission:update user');
Route::delete('/deleteUser/{id}',[App\Http\Controllers\UserController::class,'deleteUser'])->name('deleteUser')->middleware('permission:delete user');
Route::get('/editAssigningRolesToUser/{id}',[App\Http\Controllers\UserController::class,'editAssigningRolesToUser'])->name('editAssigningRolesToUser');
Route::put('/updateAssigningRolesToUser/{id}',[App\Http\Controllers\UserController::class,'updateAssigningRolesToUser'])->name('updateAssigningRolesToUser');

//route related to Roles
Route::get('/editAssigningPermissionToRole/{id}',[App\Http\Controllers\RoleController::class,'editAssigningPermissionToRole'])->name('editAssigningPermissionToRole')->middleware('permission:assign permissions to role');
Route::put('/updateAssigningPermissionToRole/{id}',[App\Http\Controllers\RoleController::class,'updateAssigningPermissionToRole'])->name('updateAssigningPermissionToRole')->middleware('permission:assign permissions to role');
Route::post('/createRole',[App\Http\Controllers\RoleController::class,'createRole'])->name('createRole')->middleware('permission:create role');
Route::get('/getRoles',[App\Http\Controllers\RoleController::class,'getRoles'])->name('getRoles')->middleware('permission:display role list');
Route::get('/editRole/{id}',[App\Http\Controllers\RoleController::class,'editRole'])->name('editRole')->middleware('permission:update role');;
Route::put('/updateRole/{id}',[App\Http\Controllers\RoleController::class,'updateRole'])->name('updateRole')->middleware('permission:update role');;

//routes related to permissions
Route::get('/getAllPermissions',[App\Http\Controllers\PermissionController::class,'getAllPermissions'])->name('getAllPermissions')->middleware('permission:display permissions');
//Testing purpose :-
Route::get('/createPermission',[App\Http\Controllers\PermissionController::class,'createPermission'])->name('createPermission');

//routes related to ward
Route::get('/getWards',[App\Http\Controllers\WardController::class,'getWards'])->name('getWards')->middleware('permission:display wards');
Route::post('/createWard',[App\Http\Controllers\WardController::class,'createWard'])->name('createWard')->middleware('permission:create ward');
Route::get('/editWard/{id}',[App\Http\Controllers\WardController::class,'editWard'])->name('editWard')->middleware('permission:update ward');
Route::put('/updateWard/{id}',[App\Http\Controllers\WardController::class,'updateWard'])->name('updateWard')->middleware('permission:update ward');
Route::delete('/deleteWard/{id}',[App\Http\Controllers\WardController::class,'deleteWard'])->name('deleteWard')->middleware('permission:delete ward');
