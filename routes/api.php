<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('config-cache',function (){
   \Illuminate\Support\Facades\Artisan::call('config:cache');
   \Illuminate\Support\Facades\Artisan::call('cache:clear');
});
// Matches "/api/login"
Route::post('login', [AuthController::class,'login']);

Route::middleware(['auth:api'])->group(function () {

    Route::get('auth/user', [AuthController::class,'getAuthUserData']);
    // Role
    Route::get('/role/list',[\App\Http\Controllers\Api\RoleController::class,'getRoleList'])->middleware('permission:task-list');
    Route::get('/view/role/{id}',[\App\Http\Controllers\Api\RoleController::class,'getRole'])->middleware('permission:task-view');
    Route::post('/add/role',[\App\Http\Controllers\Api\RoleController::class,'add'])->middleware('permission:task-add');
    Route::put('/update/role/{id}',[\App\Http\Controllers\Api\RoleController::class,'update'])->middleware('permission:task-edit');
    Route::delete('/delete/role/{id}',[\App\Http\Controllers\Api\RoleController::class,'delete'])->middleware('permission:task-delete');

    // Task
    Route::get('/task/list',[\App\Http\Controllers\Api\TaskController::class,'getTaskList'])->middleware('permission:task-list');
    Route::get('/view/task/{id}',[\App\Http\Controllers\Api\TaskController::class,'getTask'])->middleware('permission:task-view');
    Route::post('/add/task',[\App\Http\Controllers\Api\TaskController::class,'add'])->middleware('permission:task-add');
    Route::put('/update/task/{id}',[\App\Http\Controllers\Api\TaskController::class,'update'])->middleware('permission:task-edit');
    Route::delete('/delete/task/{id}',[\App\Http\Controllers\Api\TaskController::class,'delete'])->middleware('permission:task-delete');

    // User Role Association
    Route::post('/add/user/role',[\App\Http\Controllers\Api\PermissionController::class,'setUserRole'])->middleware('permission:user-role-add');

    // Role permission Association
    Route::post('/add/role/permission',[\App\Http\Controllers\Api\PermissionController::class,'setRolePermission'])->middleware('permission:role-permission-add');

});
