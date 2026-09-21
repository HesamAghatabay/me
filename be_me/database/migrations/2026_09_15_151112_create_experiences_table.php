<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->json('role');                               // دوزبانه (fa, en)
            $table->json('company');                            // دوزبانه (fa, en)
            $table->json('employment_type')->nullable();        // دوزبانه (تمام‌وقت / Full-time)
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->json('description')->nullable();            // دوزبانه (شرح وظایف)
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
