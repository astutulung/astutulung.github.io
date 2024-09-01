<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Http\Middleware\EnsureUserRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('auth', [
            EnsureUserIsAuthenticated::class,
        ]);

        $middleware->appendToGroup('role:admin', [
            EnsureUserRole::class,
        ]);

        $middleware->appendToGroup('role:panitia', [
            EnsureUserRole::class,
        ]);

        $middleware->appendToGroup('role:siswa', [
            EnsureUserRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
