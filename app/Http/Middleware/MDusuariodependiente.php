<?php

namespace App\Http\Middleware;

use Closure;

class MDusuariodependiente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuario_actual = \Auth::user();
        if($usuario_actual->role!=2){
            return view('mensajes.error')->with('mensaje', 'No tienes permisos');
        }
        return $next($request);
    }
}
