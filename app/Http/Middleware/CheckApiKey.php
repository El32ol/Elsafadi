<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) 
    {

        $apiKey = $request->header('x-api_key');// the name mine of fun inside header

        // check and comparing the value with the entre value
        if($apiKey !== config('app.api_key'))
        {
            return Response::json([
                'message' => 'invalid key',
            ], 400);
        }
        $user = Auth::guard('sanctum')->user();
        //check for if i have user ok
        if ($user) {
            
        $user->currentAccessToken()->forceFill([
            'ip_address' => $request->ip(),
        ])->save();
        }
        return $next($request);
    }
}
