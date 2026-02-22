<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateCompanySettingsRequest;
use App\Settings\CompanySetting;
use Illuminate\Http\JsonResponse;

/**
 * @tags Settings
 */
class CompanySettingsController extends Controller
{
    public function __construct(
        private CompanySetting $settings
    ) {}

    public function show(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'phone' => $this->settings->phone,
                'email' => $this->settings->email,
                'address' => $this->settings->address,
                'google_map_url' => $this->settings->google_map_url,
                'embed_google_url' => $this->settings->embed_google_url,
            ],
        ]);
    }

    public function update(UpdateCompanySettingsRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $this->settings->fill($validated);
        $this->settings->save();

        return response()->json([
            'success' => true,
            'message' => 'Company settings updated successfully',
            'data' => [
                'phone' => $this->settings->phone,
                'email' => $this->settings->email,
                'address' => $this->settings->address,
                'google_map_url' => $this->settings->google_map_url,
                'embed_google_url' => $this->settings->embed_google_url,
            ],
        ]);
    }
}
