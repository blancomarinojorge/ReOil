<?php

use App\Http\Controllers\Auth\RedirectHomeController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Middleware\Auth\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::view('/', 'hero-page')->name('hero.page');

Route::get('/home', RedirectHomeController::class)
    ->middleware(['auth'])
    ->name('home');

Route::get('/login', [SessionController::class,'create'])->name('login');
Route::post('/login', [SessionController::class,'store'])->name('login.store');

Route::get('/registration', array(RegistrationController::class,'create'))->name('registration');
Route::post('/registration', array(RegistrationController::class,'store'))->name('registration.store');


Route::prefix('/admin')
    ->as('admin.')
    ->middleware(['auth', IsAdmin::class])
    ->group(function(){
        Route::view('/', 'admin.index')->name('index');
    });
