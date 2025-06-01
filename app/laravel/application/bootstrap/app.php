<?php

use App\Http\Middleware\Auth\Authenticate;
use App\Http\Middleware\Auth\IsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //I override the Authenticate class so I can flash an error message to login
        $middleware->alias(['auth' => Authenticate::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
