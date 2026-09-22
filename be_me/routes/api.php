<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// دریافت لیست مهارت‌ها (پشتیبانی از تیکر با کوئری پارامتر ticker=1)
Route::apiResource('skills', SkillController::class)->only(['index']);

// دریافت لیست پروژه‌ها و نمایش جزئیات پروژه با اسلاگ (Case Study)
Route::apiResource('projects', ProjectController::class)
    ->only(['index', 'show'])
    ->scoped(['project' => 'slug']);

// دریافت لیست خدمات
Route::apiResource('services', ServiceController::class)->only(['index']);

// دریافت لیست سوابق کاری و تجربیات
Route::apiResource('experiences', ExperienceController::class)->only(['index']);

// ثبت فرم تماس و ارسال پیام جدید
Route::apiResource('messages', MessageController::class)->only(['store']);
