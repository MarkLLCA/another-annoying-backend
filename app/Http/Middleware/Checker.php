<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Checker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        //stores the user request in a variable
        $user = $request->user();
        $dbuser = User::where('email', $user->email)->first();

        //checks if the user exist in the database in a switch case
        switch ($user) {
            case $user->role === 'admin':
                return response()->json(['message' => 'Access granted'], 200);
                break;
            case $user->role === 'user':
                return response()->json(['message' => 'Access denied'], 403);
                break;
            default:
                return response()->json(['message' => 'User not found'], 404);
        }
        
        return $next($request);
    }
}
