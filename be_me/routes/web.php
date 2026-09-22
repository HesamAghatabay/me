<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/sitemap.xml', function () {
    $projects = Project::query()
        ->where('is_published', true)
        ->orderByDesc('updated_at')
        ->get(['slug', 'updated_at']);

    $siteUrl = rtrim(config('app.frontend_url', config('app.url')), '/');

    return response()
        ->view('sitemap', [
            'siteUrl'  => $siteUrl,
            'projects' => $projects,
        ])
        ->header('Content-Type', 'text/xml');
});

