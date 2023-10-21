<?php

namespace App\Http\Middleware;

use App\Services\PermissionService;
use App\Traits\ApiResponse;
use App\Utils\ApiStatusCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission_key): Response
    {
        return $next($request);

        if(empty($permission_key)){
            return $this->sendApiResponse(ApiStatusCode::FAILED,[],__('Permission Key is missing'));
        }

        $permission_list = (new PermissionService())->getPermissionByUserId(auth()->user()->id);

        if(!in_array($permission_key,$permission_list->toArray())){
            return $this->sendApiResponse(ApiStatusCode::PERMISSION_DENIED,[],__('You do not have permission this route'));
        }

        return $next($request);
    }
}
