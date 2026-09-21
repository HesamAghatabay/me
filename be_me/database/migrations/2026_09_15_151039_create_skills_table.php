<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // پشتیبانی از fa و en
            $table->string('category', 50)->default('backend'); // یا json('category') در صورت تمایل به تغییر نام دسته از پنل
            $table->string('icon', 80)->nullable(); // نام آیکون متریال یا SVG
            $table->boolean('in_ticker')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
