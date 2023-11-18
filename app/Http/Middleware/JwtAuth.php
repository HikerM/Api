<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;
use Illuminate\Http\Request;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (!\Jwt::check($request, '')) {
            throw new ApiException('AUTHORIZATION验证失败', 'AUTHORIZATION_INVALID', 401);
        }

        return $next($request);
    }
}
