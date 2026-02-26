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
        try {
            // 1. Ambil data dari GA4
            $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
            $topBrowsers = Analytics::fetchTopBrowsers(Period::days(7));
            $topByCountry = Analytics::get(Period::months(1), ['activeUsers'], ['country'], 10);

            // 2. Cek apakah ada data. Jika total visitors adalah 0, kita anggap data belum ada
            if ($analyticsData->isEmpty() || $analyticsData->sum('visitors') == 0) {
                return response()->json($this->getDummyData("Data belum tersedia di GA4"));
            }

            // 3. Jika ada data, kembalikan data asli
            return response()->json([
                'success' => true,
                'message' => 'Real-time data dari Google Analytics',
                'data' => [
                    'total_visitors' => $analyticsData->sum('visitors'),
                    'page_views' => $analyticsData->sum('pageViews'),
                    'top_browsers' => $topBrowsers->map(fn($b) => [
                        'browser' => $b['browser'],
                        'sessions' => $b['sessions']
                    ]),
                    'top_countries' => $topByCountry->map(fn($c) => [
                        'country' => $c['country'],
                        'active_users' => $c['activeUsers']
                    ]),
                ],
            ]);

        } catch (\Exception $e) {
            // Jika API Error (misal: Property ID salah/Auth Error), tampilkan dummy
            return response()->json($this->getDummyData("Menampilkan data simulasi (API Error)"));
        }
    }

    /**
     * Helper untuk menyediakan data dummy dengan filter negara spesifik
     */
    private function getDummyData(string $message): array
    {
        return [
            'success' => true,
            'message' => $message,
            'is_dummy' => true,
            'data' => [
                'total_visitors' => 75, // Total di bawah 200
                'page_views' => 92,
                'top_browsers' => [
                    ['browser' => 'Chrome', 'sessions' => 20],
                    ['browser' => 'Safari', 'sessions' => 4],
                    ['browser' => 'Others', 'sessions' => 5],
                ],
                'top_countries' => [
                    ['country' => 'Spain', 'active_users' => 40],     // Mayoritas
                    ['country' => 'Indonesia', 'active_users' => 10], // Data Indonesia
                    ['country' => 'Italy', 'active_users' => 15],     // Data Italia
                ],
            ],
        ];
    }
}
