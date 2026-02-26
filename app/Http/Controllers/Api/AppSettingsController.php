<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateAppSettingsRequest;
use App\Settings\AppSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * @tags Settings
 */
class AppSettingsController extends Controller
{
    public function __construct(
        private AppSettings $settings
    ) {}

    public function show(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'title' => $this->settings->title,
                'description' => $this->settings->description,
                'keywords' => $this->settings->keywords,
                'favicon' => $this->settings->favicon ? asset('storage/'.$this->settings->favicon) : null,
                'logo' => $this->settings->logo ? asset('storage/'.$this->settings->logo) : null,
                'logo_dark' => $this->settings->logo_dark ? asset('storage/'.$this->settings->logo_dark) : null,
                'default_language' => $this->settings->default_language,
                'default_target_language' => $this->settings->default_target_language,
                'translation_ai_service' => $this->settings->translation_ai_service,
                'gemini_api_key' => Hash::make($this->settings->gemini_api_key),
                'gemini_api_url' => $this->settings->gemini_api_url,
                'openai_api_key' => Hash::make($this->settings->openai_api_key),
                'openai_api_url' => $this->settings->openai_api_url,
            ],
        ]);
    }

    public function update(UpdateAppSettingsRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('favicon')) {
            if ($this->settings->favicon) {
                Storage::disk('public')->delete($this->settings->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($this->settings->logo) {
                Storage::disk('public')->delete($this->settings->logo);
            }
            $validated['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('logo_dark')) {
            if ($this->settings->logo_dark) {
                Storage::disk('public')->delete($this->settings->logo_dark);
            }
            $validated['logo_dark'] = $request->file('logo_dark')->store('settings', 'public');
        }

        $this->settings->fill($validated);
        $this->settings->save();

        return response()->json([
            'success' => true,
            'message' => 'App settings updated successfully',
            'data' => [
                'title' => $this->settings->title,
                'description' => $this->settings->description,
                'keywords' => $this->settings->keywords,
                'favicon' => $this->settings->favicon ? Storage::url($this->settings->favicon) : null,
                'logo' => $this->settings->logo ? Storage::url($this->settings->logo) : null,
                'logo_dark' => $this->settings->logo_dark ? Storage::url($this->settings->logo_dark) : null,
                'default_language' => $this->settings->default_language,
                'default_target_language' => $this->settings->default_target_language,
                'translation_ai_service' => $this->settings->translation_ai_service,
                'gemini_api_key' => $this->settings->gemini_api_key,
                'gemini_api_url' => $this->settings->gemini_api_url,
                'openai_api_key' => $this->settings->openai_api_key,
                'openai_api_url' => $this->settings->openai_api_url,
            ],
        ]);
    }
}
