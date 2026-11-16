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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('عام');
            $table->date('date_start');
            $table->date('date_end')->nullable();
            $table->string('date_text');
            $table->string('location');
            $table->decimal('price', 8, 2)->default(0.00);
            $table->string('image');
            $table->text('description');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('tickets_available')->default(150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
