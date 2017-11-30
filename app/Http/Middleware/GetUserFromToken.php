<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class GetUserFromToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return error(400004, 'user not found');
            }
        } catch (TokenExpiredException $e) {
            return error(400001, 'token expired');
        } catch (TokenInvalidException $e) {
            return error(400003, 'token invalid');
        } catch (JWTException $e) {
            return error(400002, 'token absent');
        }
        return $next($request);
    }

}
