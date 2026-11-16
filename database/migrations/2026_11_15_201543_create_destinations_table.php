<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description');
            $table->text('story')->nullable();
            $table->string('region')->default('جازان');
            $table->string('location_name');
            $table->decimal('latitude', 10, 7)->default(16.8892);
            $table->decimal('longitude', 10, 7)->default(42.5611);
            $table->string('image');
            $table->json('gallery')->nullable();
            $table->string('best_time')->default('الصباح الباكر');
            $table->string('duration')->default('ساعتان');
            $table->string('difficulty')->default('سهل');
            $table->boolean('is_family_friendly')->default(true);
            $table->boolean('has_parking')->default(true);
            $table->string('road_condition')->default('مفتوح وممهد');
            $table->string('weather_summary')->default('معتدل 24°C');
            $table->decimal('rating', 3, 2)->default(4.80);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->boolean('is_featured')->default(false);
            $table->json('tags')->nullable();
            $table->json('facilities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
