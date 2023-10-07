<?php

namespace App\Http\Middleware;

use Closure;

class UserVerifiedMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is logged in and their 'verified' column is true
        if ($request->user() && $request->user()->verified) {
            return $next($request);
        }

        // Redirect to a different route or return an error response
        return redirect('/')->with('fail',"Please ask admin to verify your account");
    }
}
