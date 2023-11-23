<?php

use App\Http\Controllers\HomePage;
use App\Http\Controllers\language\LanguageController;
use App\Livewire\Dashboard;
use App\Livewire\HumanResource\Attendance\Fingerprints;
use App\Livewire\HumanResource\Messages\Personal;
use App\Livewire\HumanResource\Structure\Centers;
use App\Livewire\HumanResource\Structure\Departments;
use App\Livewire\HumanResource\Structure\Employees;
use App\Livewire\HumanResource\Structure\Positions;
use App\Livewire\Misc\ComingSoon;
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

Route::get('/', [HomePage::class, 'index']);
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::prefix('attendance')->group(function () {
        Route::get('/fingerprints', Fingerprints::class)->name('attendance-fingerprints');
        Route::get('/leaves', ComingSoon::class)->name('attendance-leaves');
    });

    Route::prefix('structure')->group(function () {
        Route::get('/centers', Centers::class)->name('structure-centers');
        Route::get('/departments', Departments::class)->name('structure-departments');
        Route::get('/positions', Positions::class)->name('structure-positions');
        Route::get('/employees', Employees::class)->name('structure-employees');
    });

    Route::prefix('messages')->group(function () {
        Route::get('/bulk', ComingSoon::class)->name('messages-bulk');
        Route::get('/personal', Personal::class)->name('messages-personal');
    });

    Route::get('/discounts', ComingSoon::class)->name('discounts');
    Route::get('/holidays', ComingSoon::class)->name('holidays');
    Route::get('/statistics', ComingSoon::class)->name('statistics');

    Route::prefix('settings')->group(function () {
        Route::get('/rules', ComingSoon::class)->name('settings-rules');
        Route::get('/roles&permissions', ComingSoon::class)->name('settings-roles&permissions');
        Route::get('/users', ComingSoon::class)->name('settings-users');
    });

    Route::get('/roles', ComingSoon::class)->name('roles');

    Route::get('/products', ComingSoon::class)->name('products');
    Route::get('/categories', ComingSoon::class)->name('categories');
    Route::get('/transfers', ComingSoon::class)->name('transfers');
    Route::get('/reports', ComingSoon::class)->name('reports');
});
