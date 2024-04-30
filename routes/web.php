<?php

use App\Http\Controllers\HomePage;
use App\Http\Controllers\language\LanguageController;
use App\Livewire\ContactUs;
use App\Livewire\Dashboard;
use App\Livewire\HumanResource\Attendance\Fingerprints;
use App\Livewire\HumanResource\Attendance\Leaves;
use App\Livewire\HumanResource\Discounts;
use App\Livewire\HumanResource\Holidays;
use App\Livewire\HumanResource\Messages;
use App\Livewire\HumanResource\Statistics;
use App\Livewire\HumanResource\Structure\Centers;
use App\Livewire\HumanResource\Structure\Departments;
use App\Livewire\HumanResource\Structure\EmployeeInfo;
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
    // 👉 Dashboard
    Route::group(['middleware' => ['role:Admin|Assets|HR']], function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
    });

    // 👉 Human Resource
    Route::group(['middleware' => ['role:Admin|HR']], function () {
        Route::prefix('attendance')->group(function () {
            Route::get('/fingerprints', Fingerprints::class)->name('attendance-fingerprints');
            Route::get('/leaves', Leaves::class)->name('attendance-leaves');
        });
    });

    Route::group(['middleware' => ['role:Admin|Assets|HR']], function () {
        Route::prefix('structure')->group(function () {
            Route::get('/centers', Centers::class)->name('structure-centers');
            Route::get('/departments', Departments::class)->name('structure-departments');
            Route::get('/positions', Positions::class)->name('structure-positions');
            Route::get('/employees', Employees::class)->name('structure-employees');
            Route::get('/employee/{id?}', EmployeeInfo::class)->name('structure-employees-info');
        });
    });

    Route::group(['middleware' => ['role:Admin|HR']], function () {
        Route::get('/messages', Messages::class)->name('messages');
        Route::get('/discounts', Discounts::class)->name('discounts');
        Route::get('/holidays', Holidays::class)->name('holidays');
    });

    Route::group(['middleware' => ['role:Admin|Assets|HR']], function () {
        Route::get('/statistics', Statistics::class)->name('statistics');
    });

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::prefix('settings')->group(function () {
            Route::get('/rules', ComingSoon::class)->name('settings-rules');
            Route::get('/roles&permissions', ComingSoon::class)->name('settings-roles&permissions');
            Route::get('/users', ComingSoon::class)->name('settings-users');
        });
    });

    // 👉 Assets
    Route::group(['middleware' => ['role:Admin|Assets']], function () {
        Route::get('/products', ComingSoon::class)->name('products');
        Route::get('/categories', ComingSoon::class)->name('categories');
        Route::get('/transfers', ComingSoon::class)->name('transfers');
    });
    Route::group(['middleware' => ['role:Admin|Assets|HR']], function () {
        Route::get('/reports', ComingSoon::class)->name('reports');
    });
});

Route::get('/contact-us', ContactUs::class)->name('contact-us');
