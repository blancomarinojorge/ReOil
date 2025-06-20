<?php

use App\Http\Controllers\PickupResidueContainerController;
use App\Http\Controllers\Web\Auth\RedirectHomeController;
use App\Http\Controllers\Web\Auth\RegistrationController;
use App\Http\Controllers\Web\Auth\SessionController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\CompanyController;
use App\Http\Controllers\Web\ContainerController;
use App\Http\Controllers\Web\ContainerTypeController;
use App\Http\Controllers\Web\ResidueController;
use App\Http\Controllers\Web\RouteController;
use App\Http\Controllers\Web\RoutePickupController;
use App\Http\Controllers\Web\TruckController;
use App\Http\Controllers\Web\UserController;
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

    // Employees routes, this is what looks like if i do it manually, without resources (menos magia)
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

    //Company, i make it a singleton because a user can only have one company attached (/companies/34 doesnt make much sense)
    Route::singleton('company', CompanyController::class)
        ->middleware(IsAdmin::class)
        ->names('company');
    Route::resource('clients', ClientController::class)->names('clients');
    Route::resource('residues', ResidueController::class)->names('residues');
    Route::resource('container_types', ContainerTypeController::class)->names('container_types');
    Route::resource('containers', ContainerController::class)->names('containers');
    Route::resource('routes', RouteController::class)->names('routes');

    ###### RoutePickup
    //for pickups, i make the routes depend on Route when there is no id of the pickup, otherwise i just use normal routes, doing something like /routes/3/pickups/5 will just overcomplicate things
    // Nested pickups for a route
    Route::get('/routes/{route}/pickups', [RoutePickupController::class, 'index'])->name('routes.pickups.index');
    Route::get('/routes/{route}/pickups/create', [RoutePickupController::class, 'create'])->name('routes.pickups.create');
    Route::post('/routes/{route}/pickups', [RoutePickupController::class, 'store'])->name('routes.pickups.store');
    // Flat routes for individual pickups
    Route::get('/pickups/{pickup}', [RoutePickupController::class, 'show'])->name('pickups.show');
    Route::get('/pickups/{pickup}/edit', [RoutePickupController::class, 'edit'])->name('pickups.edit');
    Route::put('/pickups/{pickup}', [RoutePickupController::class, 'update'])->name('pickups.update');
    Route::delete('/pickups/{pickup}', [RoutePickupController::class, 'destroy'])->name('pickups.destroy');


    Route::delete('/pickups/{pickup}/containers/{container}', [PickupResidueContainerController::class, 'destroy'])->name('pickups.containers.residues.destroy');
});

