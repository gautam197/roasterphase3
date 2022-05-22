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

use App\Http\Livewire\Users;
use App\Http\Livewire\CreateUsers;
use App\Http\Livewire\EditUsers;

use App\Http\Livewire\Roles\Roles;
use App\Http\Livewire\Roles\CreateRoles;
use App\Http\Livewire\Roles\EditRoles;

use App\Http\Livewire\Permissions\Permissions;
use App\Http\Livewire\Permissions\CreatePermissions;
use App\Http\Livewire\Permissions\EditPermissions;

use App\Http\Livewire\Rosters\Rosters;
use App\Http\Livewire\Rosters\CreateRosters;
use App\Http\Livewire\Rosters\EditRosters;
use App\Http\Livewire\ClockInClockOut\ClockInClockOut;
use App\Http\Livewire\ClockInClockOut\EditClockInClockOut;
use App\Http\Livewire\ClockInClockOut\ViewClockInClockOut;
use App\Http\Livewire\Departments\Departments;
use App\Http\Livewire\Departments\CreateDepartments;
use App\Http\Livewire\Departments\EditDepartments;

use App\Http\Controllers\ClockInClockOutController;
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//    routes for users
    Route::get('/users', Users::class)->name('users')->middleware('permission:view-users');
    Route::get('/users/create', CreateUsers::class)->name('users.create')->middleware('permission:alter-users');
    Route::get('/users/edit/{user}', EditUsers::class)->name('users.edit')->middleware('permission:alter-users');
//    routes for roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('', Roles::class)->name('roles')->middleware('permission:view-roles');;
        Route::get('create', CreateRoles::class)->name('roles.create')->middleware('permission:alter-roles');;
        Route::get('edit/{role}', EditRoles::class)->name('roles.edit')->middleware('permission:alter-roles');;
    });

//    routes for permissions
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('', Permissions::class)->name('permissions')->middleware('permission:view-permissions');;
        Route::get('create', CreatePermissions::class)->name('permissions.create')->middleware('permission:alter-permissions');;
        Route::get('edit/{permission}', EditPermissions::class)->name('permissions.edit')->middleware('permission:alter-permissions');;
    });

    //    routes for permissions
    Route::group(['prefix' => 'departments'], function () {
        Route::get('', Departments::class)->name('departments')->middleware('permission:view-departments');
        Route::get('create', CreateDepartments::class)->name('departments.create')->middleware('permission:alter-departments');
        Route::get('edit/{department}', EditDepartments::class)->name('departments.edit')->middleware('permission:alter-departments');
    });

//    routes for rosters
    Route::group(['prefix' => 'rosters'], function () {
        Route::get('', Rosters::class)->name('rosters')->middleware('permission:view-rosters');
        Route::get('create', CreateRosters::class)->name('rosters.create')->middleware('permission:alter-rosters');
        Route::get('edit/{roster}', EditRosters::class)->name('rosters.edit')->middleware('permission:alter-rosters');
    });

//    routes for shifts
    Route::group(['prefix' => 'shifts'], function () {
        Route::get('', ClockInClockOut::class)->name('shifts')->middleware('permission:view-clock-in-clock-out');
        Route::get('edit/{clock_in_clock_out}', EditClockInClockOut::class)->name('shifts.edit')->middleware('permission:alter-clock-in-clock-out');
        Route::get('view/{clock_in_clock_out}', ViewClockInClockOut::class)->name('shifts.view')->middleware('permission:view-clock-in-clock-out');
    });

//    routes for clock in clock out
    Route::controller(ClockInClockOutController::class)->group(function () {
        Route::post('/clock-in', 'clockIn');
        Route::post('/clock-out', 'clockOut');
        Route::post('/approve-shift/{id}', 'approveShift');
        Route::post('/reject-shift/{id}', 'rejectShift');
//        Route::post('/send-approve-request', 'approveRequest');
    });
});
