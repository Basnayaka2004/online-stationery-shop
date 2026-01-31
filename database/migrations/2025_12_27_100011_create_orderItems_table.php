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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // Foreign key to Orders
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            // Foreign key to CartItems
            $table->foreignId('cart_item_id')->constrained('cart_items')->onDelete('cascade');

            $table->integer('quantity')->default(1);
            $table->decimal('price_at_purchase', 10, 2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
