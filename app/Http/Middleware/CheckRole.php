<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userRole = auth()->user()->role;

        // Check if user has required role
        if (!in_array($userRole, $roles)) {
            // Define role-based redirects
            $redirects = [
                'admin' => '/admin/dashboard',
                'user' => '/user/main',
            ];

            // Get appropriate redirect URL
            $redirectUrl = $redirects[$userRole] ?? '/';

            // Create appropriate error message
            $message = $userRole === 'admin' 
                ? 'Admin tidak dapat mengakses halaman user.' 
                : 'User tidak dapat mengakses halaman admin.';

            return redirect($redirectUrl)->with('error', $message);
        }

        return $next($request);
    }
}
