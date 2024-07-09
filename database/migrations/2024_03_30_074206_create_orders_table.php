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
            $table->id()->from(0001000);
            $table->string('ref');

            $table->unsignedBigInteger('customer_id');
            $table->string('price');
            $table->string('payment_type');
            $table->string('downpayment')->nullable();
            $table->text('checkout_url')->nullable();
            $table->string('paymongo_id')->nullable();
            $table->string('payment_status')->default('onprocess');
            $table->string('status')->default('processing');
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
