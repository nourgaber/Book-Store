<?php

namespace App\Http\Middleware;
use App\Services\RoleService;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        RoleService::authorizeRoles($request->user('api'),['manager']);
        return $next($request);
    }
}
