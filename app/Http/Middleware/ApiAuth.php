<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ApiAuth
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
        $token = $request->header('token', false);
        if ($token) {
            $user = User::where('api_token', $token)->first();
            if ($user) {
                $request->route()->setParameter('api_user', $user);
                return $next($request);
            } else {
                return response()->json(array(
                    'status' => false,
                    'message' => 'user not found',
                ));
            }
        } else {
            return response()->json(array(
                'status' => false,
                'message' => 'missing or wrong token',
            ));
        }
    }
}
