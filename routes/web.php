<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\WalletController;
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

Route::get('/', [DashboardController::class, 'index']);

//Route::resource('users', ContactController::class);
//Route::resource('wallets', WalletController::class);
//Route::resource('sections', SectionController::class);
//Route::resource('contacts', ContactController::class);

Route::resources([
    'wallets' => WalletController::class,
    'sections' => SectionController::class,
    'contacts' => ContactController::class,
]);

Route::get('get-section-type', [SectionController::class, 'getSectionType'])
    ->name('sections.sectionType');

Route::get('/subsections/{subsection}/edit', [SectionController::class, 'edit_subsection'])
    ->name('subSections.edit');

Route::get('get-weeks', [DashboardController::class, 'getWeekSt'])
    ->name('dashboard.getWeeks');

Route::get('{any}', function () {
    return view('pages.treatment.index');
})->where('any', '.*');
