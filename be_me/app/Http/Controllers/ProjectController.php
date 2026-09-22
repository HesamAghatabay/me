<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(): JsonResponse
    {
        $projects = Project::query()
            ->where('is_published', true)
            ->with(['skills', 'media'])
            ->orderBy('sort_order')
            ->get()
            ->map(function (Project $project) {
                /** @var Media|null $primaryMedia */
                $primaryMedia = $project->media->firstWhere('is_primary', true) ?? $project->media->first();

                return [
                    'id' => $project->id,
                    'title' => $project->getTranslations('title'),
                    'slug' => $project->slug,
                    'summary' => $project->getTranslations('summary'),
                    'demo_url' => $project->demo_url,
                    'github_url' => $project->github_url,
                    'is_featured' => (bool) $project->is_featured,
                    'cover_image' => $primaryMedia ? asset('storage/' . $primaryMedia->file_path) : null,
                    'skills' => $project->skills->map(fn (Skill $skill) => [
                        'id' => $skill->id,
                        'name' => $skill->getTranslations('name'),
                    ]),
                ];
            });

        return response()->json($projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): JsonResponse
    {
        $project->load(['skills', 'media']);

        return response()->json([
            'id' => $project->id,
            'title' => $project->getTranslations('title'),
            'slug' => $project->slug,
            'summary' => $project->getTranslations('summary'),
            'description' => $project->getTranslations('description'),
            'demo_url' => $project->demo_url,
            'github_url' => $project->github_url,
            'skills' => $project->skills->map(fn (Skill $skill) => [
                'id' => $skill->id,
                'name' => $skill->getTranslations('name'),
            ]),
            'gallery' => $project->media->map(fn (Media $media) => [
                'id' => $media->id,
                'url' => asset('storage/' . $media->file_path),
                'alt_text' => $media->getTranslations('alt_text'),
                'is_primary' => (bool) $media->is_primary,
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
