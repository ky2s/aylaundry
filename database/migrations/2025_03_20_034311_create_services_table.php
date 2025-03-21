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
        Schema::create('services', function (Blueprint $table) {
            $table->id('id');
            $table->string('service_name', 50);
            $table->text('description')->nullable();
            $table->decimal('price_per_kg', 10, 2)->nullable();
            $table->decimal('price_per_item', 10, 2)->nullable();
            $table->integer('estimated_time')->comment('Estimasi waktu dalam jam')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
