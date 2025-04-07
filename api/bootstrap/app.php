<?php

use App\Helpers\ReturnMessage;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($e instanceof ValidationException) {
                return ReturnMessage::error('Erro de validação', $e->getMessage(), [
                    'errors' => $e->validator->errors(),
                ], 422);
            }

            if ($e instanceof AuthenticationException) {
                return ReturnMessage::error('Não autenticado', $e->getMessage(), [], 401);
            }

            if ($e instanceof QueryException) {
                return ReturnMessage::error('Erro de banco de dados', $e->getMessage(), [], 500);
            }
            
            return ReturnMessage::error('Erro inesperado', $e->getMessage(), [], 500);

        });
    })
    ->create();
