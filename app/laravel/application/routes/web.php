<?php

use App\Http\Controllers\Auth\RedirectHomeController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Auth\IsAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'hero-page')->name('hero.page');

//Guest app views. By default, if they are authenticated, they are redirected to the named route home. Then I check what view to show depending on the user role.
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class,'create'])->name('login');
    Route::post('/login', [SessionController::class,'store'])->name('login.store');
    Route::get('/registration', array(RegistrationController::class,'create'))->name('registration');
    Route::post('/registration', array(RegistrationController::class,'store'))->name('registration.store');
});

// Authenticated views
Route::middleware('auth')->group(function () {

    // Redirect users to their role-specific home
    Route::get('/home', RedirectHomeController::class)
        ->name('home');

    // Admin specific routes
    Route::prefix('/admin')
        ->as('admin.')
        ->middleware(IsAdmin::class)
        ->group(function () {
            Route::view('/', 'admin.index')->name('dashboard');
        });

    // Office specific routes
    Route::prefix('/office')
        ->as('office.')
        ->group(function () {
            Route::view('/', 'office.dashboard')->name('dashboard');
        });

    // Employees routes
    Route::prefix('/employees')
        ->as('employees.')
        ->group(function () {
            Route::get('/', [UserController::class, 'index'])
                ->can('view-any', User::class)
                ->name('index');

            Route::get('/create', [UserController::class, 'create'])
                ->can('create', User::class)
                ->name('create');

            Route::post('/', [UserController::class, 'store'])
                ->name('store');

            Route::get('/{user}', [UserController::class, 'show'])
                ->can('view', 'user')
                ->name('show');

            Route::get('/{user}/edit', [UserController::class, 'edit'])
                ->can('update', 'user')
                ->name('edit');

            Route::put('/{user}', [UserController::class, 'update'])
                ->can('update', 'user')
                ->name('update');

            Route::delete('/{user}', [UserController::class, 'destroy'])
                ->can('delete', 'user')
                ->name('destroy');
        });

    //Truck routes. I do it with resources, applying the Policy in the controller
    Route::resource('trucks', TruckController::class)->names('trucks');
});

