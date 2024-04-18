<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Settings\PermissionIndex;
use App\Livewire\Settings\RoleIndex;
use App\Livewire\Settings\RolePermissionsEdit;
use App\Livewire\Settings\UserRolesIndex;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /* Route::get('/settings/roles', RoleIndex::class)->name('admin.roles.index');
    Route::get('/settings/permissions', PermissionIndex::class)->name('settings.permissions.index');
    Route::get('/settings/role-permissions/{role}/edit', RolePermissionsEdit::class)->name('settings.role-permissions');
    Route::get('/settings/user-has-roles', UserRolesIndex::class)->name('settings.user-roles.index'); */
});


Route::get('/test', [HomeController::class, 'test']);