<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_request', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('deli_type_id');
            $table
                ->foreign('deli_type_id')
                ->references('id')
                ->on('delivery_types')
                ->onDelete('cascade');
            $table
                ->integer('status')
                ->default('0')
                ->comment('1=approved,0=pending,3=finished');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_request');
    }
};
