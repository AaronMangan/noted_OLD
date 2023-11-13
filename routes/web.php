<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageSettingsController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests\PublicPageViewRequest;

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

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pages
    Route::resource('pages', PageController::class)->only(['index', 'create', 'show',  'edit', 'store', 'update', 'destroy']);

    // Templates
    Route::resource('templates', TemplateController::class)->only(['index', 'create', 'show', 'edit', 'store', 'update', 'destroy']);

    // Share a page.
    Route::post('/pages/{page}/share', [PageController::class, 'share'])->name('pages.share');

    // Page Settings.
    Route::resource('/pages/{page}/settings', PageSettingsController::class)->only(['create', 'store'])->name('page-settings.create', 'page-settings.store');
});

/**
 * This is the route that lets people access a page with the shared link.
 */
Route::get('/pages/{page}/public', function (PublicPageViewRequest $request, App\Models\Page $page) {
    return view('public-view', compact('page'));
})->name('page.public');

require __DIR__ . '/auth.php';
