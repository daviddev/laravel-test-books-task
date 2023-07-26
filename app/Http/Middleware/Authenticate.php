<?php

namespace App\Http\Middleware;

use App\Exceptions\HttpErrorResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * @throws HttpErrorResponse
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            throw new HttpErrorResponse(__('auth.unauthenticated'), [], 401);
        }

        return null;
    }
}
