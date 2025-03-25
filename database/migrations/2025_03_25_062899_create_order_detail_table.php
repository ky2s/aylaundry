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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('service_id')->constrained('services');
            $table->string('service_name', 50);
            $table->decimal('price_per_kg', 10, 2)->nullable();
            $table->decimal('price_per_item', 10, 2)->nullable();
            $table->integer('estimated_time')->nullable();
            $table->decimal('quantity', 10, 2);
            $table->decimal('sub_total', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
};
