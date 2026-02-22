<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
}
