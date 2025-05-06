<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Inertia\CurrentUserController;
use App\Http\Controllers\APIs\UserController;
use App\Http\Controllers\DishesController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('roles', RolesController::class);
    Route::apiresource('users', UsersController::class);
    Route::resource('dishes', DishesController::class);
    // Route::resource('dish', DishesController::class);



    // Route::post('/users/datatable', [UserController::class, 'userWithDatatable'])->name('user.with.datatable');





    // Route::resource('user', UserController::class);

    // Route::get('/datatable', function () {
    //     return view('livewire.data-table'); // หน้า DataTable ที่จะใช้ AJAX ดึงข้อมูลจาก API
    // });
});
