<?php

<<<<<<< HEAD
=======
use App\Http\Middleware\AuthMiddleware;
>>>>>>> 40dbd0d (changes in auth and transactions)
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
<<<<<<< HEAD
=======
        api: __DIR__.'/../routes/api.php',
>>>>>>> 40dbd0d (changes in auth and transactions)
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
<<<<<<< HEAD
        //
=======
        $middleware->alias(['auth'=>AuthMiddleware::class]);
>>>>>>> 40dbd0d (changes in auth and transactions)
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
