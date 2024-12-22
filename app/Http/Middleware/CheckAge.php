<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Log that the middleware was executed
        Log::info('CheckAge middleware executed.');

        // Get the 'age' parameter from the query string
        $age = $request->query('age');
        Log::info('Age parameter:', ['age' => $age]);

        // Check if the age is less than 18 or missing
        if (!$age || $age < 18) {
            Log::warning('User not allowed. Age is below 18 or not provided.', ['age' => $age]);
            return redirect('/not-allowed');
        }

        Log::info('User is allowed to access the site.', ['age' => $age]);

        // Allow the request to proceed
        return $next($request);
    }
}
