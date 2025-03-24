<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('service_id')->constrained('services');
            $table->timestamp('order_date')->useCurrent();
            $table->decimal('total_weight', 5, 2)->nullable();
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'process', 'done', 'canceled'])->default('pending');
            $table->text('notes')->nullable();
            $table->boolean('pickup')->default(false);
            $table->boolean('delivery')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
