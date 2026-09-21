<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->json('title');                     // دوزبانه (fa, en)
            $table->string('slug', 160)->unique();      // شناسه یکتای انگلیسی در URL
            $table->json('summary');                   // دوزبانه (fa, en)
            $table->json('description');               // دوزبانه و متن غنی HTML
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
