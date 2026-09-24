<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', ['delivery', 'collection'])->default('delivery');
            $table->enum('payment_method', ['cash', 'paid'])->default('cash');
            $table->enum('status', ['pending', 'diproses', 'on_the_way', 'ready', 'selesai', 'dibatalkan'])->default('pending');
            $table->unsignedBigInteger('total')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
