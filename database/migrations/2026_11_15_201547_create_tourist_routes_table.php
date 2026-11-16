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
        Schema::create('tourist_routes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('badge')->nullable();
            $table->string('category')->default('الجبال والمطلات');
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->unsignedInteger('days_count')->default(1);
            $table->string('duration_text')->default('يوم واحد');
            $table->string('difficulty')->default('سهل');
            $table->decimal('rating', 3, 2)->default(4.80);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->string('image');
            $table->json('stops');
            $table->json('highlights')->nullable();
            $table->json('included_services')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourist_routes');
    }
};
