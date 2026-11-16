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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('bookable_type');
            $table->unsignedBigInteger('bookable_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->date('trip_date');
            $table->unsignedInteger('adults_count')->default(1);
            $table->unsignedInteger('children_count')->default(0);
            $table->decimal('total_price', 8, 2)->default(0.00);
            $table->string('payment_method')->default('mada');
            $table->string('payment_status')->default('paid');
            $table->string('status')->default('confirmed');
            $table->json('selected_addons')->nullable();
            $table->text('notes')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();

            $table->index(['bookable_type', 'bookable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
