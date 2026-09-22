<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $experiences = Experience::query()
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->get()
            ->map(fn($exp) => [
                'id' => $exp->id,
                'role' => $exp->getTranslations('role'),
                'company' => $exp->getTranslations('company'),
                'employment_type' => $exp->employment_type ? $exp->getTranslations('employment_type') : null,
                'start_date' => $exp->start_date,
                'end_date' => $exp->end_date,
                'is_current' => (bool) $exp->is_current,
                'description' => $exp->description ? $exp->getTranslations('description') : null,
            ]);

        return response()->json($experiences);
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
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        //
    }
}
