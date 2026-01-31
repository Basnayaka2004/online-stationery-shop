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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to Customer
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');

            // Foreign key to Cart (optional)
            $table->foreignId('cart_id')->nullable()->constrained('carts')->onDelete('set null');

            // Foreign key to Order
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            $table->string('payment_method');
            $table->decimal('payment_amount', 10, 2);
            $table->dateTime('payment_date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
