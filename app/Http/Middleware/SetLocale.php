<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (in_array($locale, ['en', 'es'])) {
            app()->setLocale($locale);

            $phpLocaleMap = [
                'en' => 'en_US.UTF-8',
                'es' => 'es_ES.UTF-8',
            ];

            if (isset($phpLocaleMap[$locale])) {
                // 👇 THIS LINE MUST HAVE LC_ALL, not $request
                \setlocale(LC_ALL, $phpLocaleMap[$locale]);
            }
        }

        return $next($request);
    }

}
