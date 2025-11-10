<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard-locateur', function () {
    return view('pages.locateur.dashboard');
});