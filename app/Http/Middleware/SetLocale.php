<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');

        if (in_array($locale, ['en', 'id'])) {
            // Set Laravel locale
            app()->setLocale($locale);

            // Optional: Set PHP locale - map to full locale code
            $phpLocale = [
                'en' => 'en_US.UTF-8',
                'id' => 'id_ID.UTF-8'
            ];

            // ✅ THIS is the correct line
            setlocale(LC_ALL, $phpLocale[$locale]);
        }

        return $next($request);
    }

}
