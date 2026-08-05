<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // cek user Jika belum login
        if (!$request->user()) {
            return redirect()->route('login')
                ->withErrors(['Silahkan login terlebih dahulu.']);
        }

        $userRole = $request->user()->role->name;

        // Jika role user tidak sesuai route yang diminta
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
