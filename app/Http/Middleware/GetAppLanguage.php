<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class GetAppLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtiene el idioma del encabezado "Accept-Language"
        $language = $request->header('Accept-Language', 'es'); // Por defecto "es" si no se envía
        $language = 'es'; // Por defecto "es" si no se envía

        // Configura el idioma en la aplicación
        App::setLocale($language);

        return $next($request);
    }
}
