<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\UserAuthentication;
use App\Http\Middleware\AdminAuthentication;
use App\Http\Middleware\SubAdminAuthentication;
use App\Http\Middleware\SuperAdminAuthentication;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
            $middleware->alias([
                'isSuperAdmin' => SuperAdminAuthentication::class,
                'isSubAdmin' => SubAdminAuthentication::class,
                'isAdmin' => AdminAuthentication::class,
                'isUser' => UserAuthentication::class,
            ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
