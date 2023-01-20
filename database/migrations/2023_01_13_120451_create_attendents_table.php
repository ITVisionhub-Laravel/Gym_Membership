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
        Schema::create('attendents', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->date('date');
            $table
                ->integer('status')
                ->default('0')
                ->comment('1=present,0=absent');
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
        Schema::dropIfExists('attendents');
    }
};
