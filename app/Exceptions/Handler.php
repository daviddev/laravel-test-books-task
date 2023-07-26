<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ValidationException $e) {
            throw new HttpErrorResponse('validation error', $e->errors(), 422);
        });
        $this->renderable(function (NotFoundHttpException $e) {
            throw new HttpErrorResponse('not found error', $e->getMessage(), 404);
        });
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
