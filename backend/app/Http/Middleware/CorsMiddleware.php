<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Get the origin from the request
        $origin = $request->header('Origin');
        
        // Get allowed origins from environment variable
        $allowedOrigins = explode(',', env('FRONTEND_URL', 'http://localhost:5173'));
        
        // Check if the origin is allowed
        if (in_array($origin, $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization, X-XSRF-TOKEN');
        }
        
        return $response;
    }
}