<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMobileListRequest;
use App\Http\Requests\Api\UpdateMobileListRequest;
use App\Models\MobileList;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @tags Mobile Lists
 */
class MobileListController extends Controller
{
    public function index(): JsonResponse
    {
        $mobileLists = MobileList::where('lang', 'en')
            ->with('sibling')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($list) {
                return [
                    'id' => $list->unique_id,
                    'logo' => $list->logo ? Storage::url($list->logo) : null,
                    'title' => $list->title,
                    'is_active' => (bool) $list->is_active,
                    'lang' => $list->lang,
                    'created_at' => $list->created_at,
                    'updated_at' => $list->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $mobileLists,
        ]);
    }

    public function store(StoreMobileListRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('mobile-lists', 'public');
        }

        $uniqueId = Str::uuid()->toString();

        $mobileList = MobileList::create([
            'unique_id' => $uniqueId,
            'logo' => $logoPath,
            'title' => $validated['title'],
            'is_active' => $validated['is_active'] ?? true,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mobile list created successfully',
            'data' => [
                'id' => $mobileList->unique_id,
                'logo' => $mobileList->logo ? Storage::url($mobileList->logo) : null,
                'title' => $mobileList->title,
                'is_active' => (bool) $mobileList->is_active,
                'lang' => $mobileList->lang,
                'created_at' => $mobileList->created_at,
                'updated_at' => $mobileList->updated_at,
            ],
        ], 201);
    }

    public function show(string $uniqueId): JsonResponse
    {
        $mobileList = MobileList::where('unique_id', $uniqueId)
            ->with('sibling')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $mobileList->unique_id,
                'logo' => $mobileList->logo ? Storage::url($mobileList->logo) : null,
                'title' => $mobileList->title,
                'is_active' => (bool) $mobileList->is_active,
                'lang' => $mobileList->lang,
                'created_at' => $mobileList->created_at,
                'updated_at' => $mobileList->updated_at,
            ],
        ]);
    }

    public function update(UpdateMobileListRequest $request, string $uniqueId): JsonResponse
    {
        $mobileList = MobileList::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($mobileList->logo) {
                Storage::disk('public')->delete($mobileList->logo);
            }
            $validated['logo'] = $request->file('logo')->store('mobile-lists', 'public');
        }

        $mobileList->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Mobile list updated successfully',
            'data' => [
                'id' => $mobileList->unique_id,
                'logo' => $mobileList->logo ? Storage::url($mobileList->logo) : null,
                'title' => $mobileList->title,
                'is_active' => (bool) $mobileList->is_active,
                'lang' => $mobileList->lang,
                'created_at' => $mobileList->created_at,
                'updated_at' => $mobileList->updated_at,
            ],
        ]);
    }

    public function destroy(string $uniqueId): JsonResponse
    {
        $mobileList = MobileList::where('unique_id', $uniqueId)->firstOrFail();

        if ($mobileList->logo) {
            Storage::disk('public')->delete($mobileList->logo);
        }

        $mobileList->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mobile list deleted successfully',
        ]);
    }
}
