<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Spatie\Analytics\OrderBy;

/**
 * @tags Dashboard
 */
class DashboardController extends Controller
{
    /**
     * Get dashboard statistics.
     *
     * @summary Get dashboard stats
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_users' => User::count(),
                'total_articles' => Article::count(),
                'total_categories' => ArticleCategory::count(),
                'active_sessions' => DB::table('personal_access_tokens')
                    ->where('last_used_at', '>=', now()->subMinutes(config('sanctum.expiration', 15)))
                    ->count(),
            ],
        ]);
    }
    public function analytics(): JsonResponse
    {
        // Mengambil data traffic (Total Visitors & Page Views) 7 hari terakhir
        $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

        // Mengambil data browser yang paling banyak digunakan
        $topBrowsers = Analytics::fetchTopBrowsers(Period::days(7));
        $topByCountry = Analytics::get(
        Period::months(1),
        ['activeUsers'], // Metric
        ['country'],     // Dimension
        10,
    );

        // Contoh respons dummy (ganti dengan data nyata dari GA4)
        return response()->json([
            'success' => true,
            'data' => [
                'total_visitors' => $analyticsData->sum('visitors'),
                'page_views' => $analyticsData->sum('pageViews'),
                'top_browsers' => $topBrowsers->map(function ($browser) {
                    return [
                        'browser' => $browser['browser'],
                        'sessions' => $browser['sessions'],
                    ];
                }),
                'top_countries' => $topByCountry->map(function ($country) {
                    return [
                        'country' => $country['country'],
                        'active_users' => $country['activeUsers'],
                    ];
                }),
            ],
        ]);
    }
}
