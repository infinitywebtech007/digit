<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/roles-and-permissions', [PermissionController::class, 'index'])->name('permissions.manage');
    Route::post('/permissions/assign-to-user', [PermissionController::class, 'assignToUser'])->name('permissions.assign.user');
    Route::post('/permissions/assign-to-role', [PermissionController::class, 'assignToRole'])->name('permissions.assign.role');
    Route::get('/api/user-permissions/{userId}', [PermissionController::class, 'getUserPermissions'])->name('api.user.permissions');
    Route::get('/api/user-roles/{userId}', [PermissionController::class, 'getUserRoles'])->name('api.user.roles');
    Route::post('/api/assign-role-to-user', [PermissionController::class, 'assignRoleToUser'])->name('api.assign.role.to.user');
    Route::get('/api/role-permissions/{roleId}', [PermissionController::class, 'getRolePermissions'])->name('api.role.permissions');
    Route::post('/api/assign-permission-to-role', [PermissionController::class, 'assignPermissionToRole'])->name('api.assign.permission.to.role');
    Route::post('/api/assign-permission-to-user', [PermissionController::class, 'assignPermissionToUser'])->name('api.assign.permission.to.user');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('parties', App\Http\Controllers\PartyController::class);
    Route::resource('calls', App\Http\Controllers\CallController::class);
});
