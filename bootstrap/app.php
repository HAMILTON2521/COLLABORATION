<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AutoAckMiddleware;
use App\Http\Middleware\JWTAuthMiddleware;
use App\Http\Middleware\SelcomMerchantMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api/',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/');
        $middleware->appendToGroup('jwt', [
            JWTAuthMiddleware::class
        ]);
        $middleware->appendToGroup('callbackAck', [
            AutoAckMiddleware::class
        ]);
        $middleware->appendToGroup('selcomMerchantToken', [
            SelcomMerchantMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
