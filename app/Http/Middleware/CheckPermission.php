<?php

namespace App\Http\Middleware;

use App\Models\Reserva;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $requiredPermission): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $userPermission = auth()->user()->permiso;

        if ($userPermission == 0) {
            return $next($request);
        }

        if ($userPermission == 2) {
            $allowedClientRoutes = [
                'reserva.index',
                'reserva.create',
                'reserva.store',
                'reserva.show',
                'orden.create',
                'orden.store'
            ];

            $routeName = $request->route()->getName();


            if (in_array($routeName, $allowedClientRoutes)) {
                if ($routeName === 'reserva.show') {
                    $reservaId = $request->route()->parameter('reserva')->id;


                    $reserva = Reserva::findOrFail($reservaId);
                    if ($reserva->user_id !== $user->id) {
                        abort(403, 'Acceso denegado.');
                    }
                }
                return $next($request);
            }

            abort(403, 'Unauthorized action');
        }

        if ($userPermission != $requiredPermission) {
            abort(403, 'Unauthorized action');
        }

        return $next($request);
    }
}