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
        Schema::create('shop_keeper_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_type_id');
            $table->integer('quantity');
            $table->integer('product_id');
            $table
                ->integer('status')
                ->default('0')
                ->comment('1=approved,0=pending,3=finished');
            $table
                ->foreign('shop_type_id')
                ->references('id')
                ->on('shop_types')
                ->onDelete('cascade');
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
        Schema::dropIfExists('shop_keeper_request');
    }
};
