<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
  
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            if (auth()->check()) {
                // Jika user sudah login, kembalikan ke dashboard admin
                return response()->view('errors.404', ['returnUrl' => '/admin/dashboard'], 404);
            } else {
                // Jika user belum login, kembalikan ke halaman utama
                return response()->view('errors.404', ['returnUrl' => '/'], 404);
            }
        }

        return parent::render($request, $exception);
    }
}
