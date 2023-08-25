<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ApiIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();
        if (!$bearerToken) {
            return response()->json('You are not logged in.', 401);
        }

        $hashed = hash('sha256', $bearerToken);
        $found = PersonalAccessToken::where('token', $hashed)->first();

        if (!$found) {
            return response()->json('No such token.', 401);
        }

        $user = User::findOrFail($found->tokenable_id);
        if(!$user->is_admin){
            return response()->json('You are not admin.', 401);
        }
        return $next($request);
    }
}
