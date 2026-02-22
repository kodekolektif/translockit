<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProjectRequest;
use App\Http\Requests\Api\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @tags Projects
 */
class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::where('lang', 'en')
            ->with(['sibling', 'service'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($project) {
                return [
                    'id' => $project->unique_id,
                    'image' => $project->image ? Storage::url($project->image) : null,
                    'name' => $project->name,
                    'description' => $project->description,
                    'service' => $project->service ? [
                        'id' => $project->service->unique_id,
                        'name' => $project->service->name,
                    ] : null,
                    'is_active' => (bool) $project->is_active,
                    'lang' => $project->lang,
                    'created_at' => $project->created_at,
                    'updated_at' => $project->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $projects,
        ]);
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        $uniqueId = Str::uuid()->toString();

        $project = Project::create([
            'unique_id' => $uniqueId,
            'image' => $imagePath,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'service_id' => $validated['service_id'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        $project->load('service');

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully',
            'data' => [
                'id' => $project->unique_id,
                'image' => $project->image ? Storage::url($project->image) : null,
                'name' => $project->name,
                'description' => $project->description,
                'service' => $project->service ? [
                    'id' => $project->service->unique_id,
                    'name' => $project->service->name,
                ] : null,
                'is_active' => (bool) $project->is_active,
                'lang' => $project->lang,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ],
        ], 201);
    }

    public function show(string $uniqueId): JsonResponse
    {
        $project = Project::where('unique_id', $uniqueId)
            ->with(['sibling', 'service'])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $project->unique_id,
                'image' => $project->image ? Storage::url($project->image) : null,
                'name' => $project->name,
                'description' => $project->description,
                'service' => $project->service ? [
                    'id' => $project->service->unique_id,
                    'name' => $project->service->name,
                ] : null,
                'is_active' => (bool) $project->is_active,
                'lang' => $project->lang,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ],
        ]);
    }

    public function update(UpdateProjectRequest $request, string $uniqueId): JsonResponse
    {
        $project = Project::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);
        $project->load('service');

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'data' => [
                'id' => $project->unique_id,
                'image' => $project->image ? Storage::url($project->image) : null,
                'name' => $project->name,
                'description' => $project->description,
                'service' => $project->service ? [
                    'id' => $project->service->unique_id,
                    'name' => $project->service->name,
                ] : null,
                'is_active' => (bool) $project->is_active,
                'lang' => $project->lang,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ],
        ]);
    }

    public function destroy(string $uniqueId): JsonResponse
    {
        $project = Project::where('unique_id', $uniqueId)->firstOrFail();

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully',
        ]);
    }
}
