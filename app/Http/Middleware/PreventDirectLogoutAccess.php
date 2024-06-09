<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PreventDirectLogoutAccess
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
        $referer = $request->headers->get('referer');
        if (!$referer || !str_contains($referer, url('/'))) {
            Log::warning('Direct access to logout route detected.', ['ip' => $request->ip(), 'url' => $request->fullUrl()]);
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
