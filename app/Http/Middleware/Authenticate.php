<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use App\Utils\ApiStatusCode;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    use ApiResponse;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if(!$request->expectsJson()){
            return $this->sendApiResponse(ApiStatusCode::BAD_REQUEST,[],'Content Type is missing');
        }

        return $request->expectsJson() ? null : route('login');
    }
}
