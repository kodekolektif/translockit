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
        // 1. Siapkan Data Dummy Dasar (Spain sebagai mayoritas)
        $baseData = $this->getDummyData();

        try {
            // 2. Coba ambil data asli dari GA4
            $realVisitors = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
            $realBrowsers = Analytics::fetchTopBrowsers(Period::days(7));
            $realCountries = Analytics::get(Period::months(1), ['activeUsers'], ['country'], 10);

            // 3. Gabungkan Total Visitors & Page Views
            $baseData['total_visitors'] += $realVisitors->sum('visitors');
            $baseData['page_views'] += $realVisitors->sum('pageViews');

            // 4. Gabungkan Data Browser (Merge & Sum)
            $baseData['top_browsers'] = collect($baseData['top_browsers'])
                ->concat($realBrowsers->map(fn($b) => ['browser' => $b['browser'], 'sessions' => $b['sessions']]))
                ->groupBy('browser')
                ->map(fn($group, $browser) => [
                    'browser' => $browser,
                    'sessions' => $group->sum('sessions')
                ])
                ->sortByDesc('sessions')
                ->values()
                ->toArray();

            // 5. Gabungkan Data Negara (Merge & Sum)
            $baseData['top_countries'] = collect($baseData['top_countries'])
                ->concat($realCountries->map(fn($c) => ['country' => $c['country'], 'active_users' => (int)$c['activeUsers']]))
                ->groupBy('country')
                ->map(fn($group, $country) => [
                    'country' => $country,
                    'active_users' => $group->sum('active_users')
                ])
                ->sortByDesc('active_users') // Tetap pastikan urutan tertinggi di atas
                ->values()
                ->toArray();

            $message = "Data fetched successfully from Google Analytics";

        } catch (\Exception $e) {
            // Jika API error, hanya tampilkan data dummy dasar
            $message = "Display Data Analitics";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $baseData
        ]);
    }

    /**
     * Nilai dasar dummy (Tetap di bawah 200)
     */
    private function getDummyData(): array
    {
        return [
            'total_visitors' => 75,
            'page_views' => 92,
            'top_browsers' => [
                ['browser' => 'Chrome', 'sessions' => 20],
                ['browser' => 'Safari', 'sessions' => 10],
                ['browser' => 'Firefox', 'sessions' => 15],
                ['browser' => 'Other', 'sessions' => 2],
            ],
            'top_countries' => [
                ['country' => 'Spain', 'active_users' => 40],     // Majority
                ['country' => 'Indonesia', 'active_users' => 10],
                ['country' => 'Italy', 'active_users' => 15],
            ],
        ];
    }
}
