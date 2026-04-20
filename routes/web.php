<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/catalogue', function () {
    return view('catalogue');
})->name('catalogue');

Route::get('/reservation', function () {
    return view('reservation');
})->name('reservation');

Route::get('/mon-compte', function () {
    return view('mon-compte');
})->name('mon-compte');

Route::get('/modifier-profil', function () {
    return view('modifier-profil');
})->name('modifier-profil');

Route::get('/chat', function () {
    return view('chat');
})->name('chat');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/reservations', function () {
    return view('admin.reservations');
});

Route::get('/admin/chat', function () {
    return view('admin.chat');
});

Route::get('/admin/users', function () {
    return view('admin.users');
});

Route::get('/admin/consoles-games', function () {
    return view('admin.consoles-games');
});
