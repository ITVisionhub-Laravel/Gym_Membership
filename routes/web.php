<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('admin');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});
Route::prefix('admin')->group(function () {
    Route::controller(
        App\Http\Controllers\Admin\DashboardController::class
    )->group(function () {
        Route::get('dashboard', 'index');
        Route::get('dashboard/create', 'create');
    });
    Route::controller(
        App\Http\Controllers\Admin\MemberControlller::class
    )->group(function () {
        Route::get('/members', 'index');
        Route::get('/members/create', 'create');
        Route::post('/members', 'store');
        Route::get('/members/{member}/edit', 'edit');
        Route::put('/members/{member}', 'update');
        Route::get('/members/{member_id}/delete', 'destroy');
    });

    Route::controller(
        App\Http\Controllers\Admin\EquipmentController::class
    )->group(function () {
        Route::get('/equipments', 'index');
        Route::get('/equipments/create', 'create');
        Route::post('/equipments', 'store');
        Route::get('/equipments/{equipment}/edit', 'edit');
        Route::put('/equipments/{equipment}', 'update');
        Route::get('/equipments/{equipment_id}/delete', 'destroy');
    });
});

require __DIR__ . '/auth.php';
