<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('post.logout');

    // PortfolioController
    Route::controller(PortfolioController::class)->group(function() {
        // Portfolio
        Route::get('portfolio', 'index')->name('portfolio');
        Route::post('portfolio', 'store')->name('store.portfolio');
        Route::post('edit-portfolio/{id}', 'editPortfolio')->name('edit.portfolio');
        Route::post('delete-portfolio/{id}', 'deletePortfolio')->name('delete.portfolio');

        Route::get('portfolio-detail/{id}', 'detail')->name('detail.portfolio');

        // Portfolio Image
        Route::post('add-portfolio-image', 'addPortfolioImage')->name('store.portfolio-image');
        Route::post('edit-portfolio-image/{id}', 'editPortfolioImage')->name('edit.portfolio-image');
        Route::post('delete-portfolio-image/{id}', 'deletePortfolioImage')->name('delete.portfolio-image');
    });

    Route::controller(ProfileController::class)->group(function() {
        Route::get('profile', 'index')->name('profile');
        Route::post('update-user/{id}', 'updateUser')->name('update.user');
        Route::post('update-profile/{id}', 'updateProfile')->name('update.profile');
        Route::post('update-socmed/{id}', 'updateSocmed')->name('update.socmed');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('post.login');
});
