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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('grand_total', 12, 2)->default(0.00);
            $table->string('payment_method', 100)->nullable();
            $table->string('payment_status', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('currency', 10)->nullable();
            $table->decimal('shipping_amount', 12, 2)->default(0.00);
            $table->string('shipping_method', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
