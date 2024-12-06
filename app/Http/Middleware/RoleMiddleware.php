<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Maneja la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles){

        $userRole = trim(strtolower($request->user()->rol->nombre ?? ''));

        \Log::info('User Role:', ['role' => $userRole]);
        \Log::info('Allowed Roles:', ['roles' => $roles]);

        if (!in_array($userRole, $roles)) {
            \Log::warning('Access denied for user with role:', ['role' => $userRole]);
            return redirect('/noAutorizado')->withErrors(['error' => 'No tienes permiso para acceder a esta página.']);
        }

        return $next($request);
    }
}