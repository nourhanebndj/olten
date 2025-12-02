<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', function () {
    return view('index');
});


Route::get('/creer-site', function () {
    return view('pages.creer_site');
})->name('creer.site');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/annonce-details', function () {
    return view('pages.annonces_pages.annonces_details');
})->name('annonces.details');

Route::view('/categories', 'pages.annonces_pages.categories_annonces')
->name('categories');

Route::get('/deposer_annonce', function () {
    return view('pages.locateur.deposer_annonce');
})->name('deposer_annonce'); 

Route::get('/favoris', function () {
    return view('pages.locateur.favoris');
})->name('favoris');

Route::get('/profile', function () {
    return view('pages.locateur.profile');
})->name('profile');

Route::get('/statistiques', function () {
    return view('pages.locateur.statistiques');
})->name('statistiques');

Route::get('/mes_annonces', function () {
    return view('pages.locateur.mes_annonces');
})->name('mes_annonces');

Route::get('/messages', function () {
    return view('pages.locateur.messages');
})->name('messages');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/modifer', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/modifer', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/supprimer', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::middleware(['auth'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/categorie', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    });

});

require __DIR__.'/auth.php';
