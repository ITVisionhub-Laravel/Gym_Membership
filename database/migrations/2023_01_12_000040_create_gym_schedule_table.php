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
        Schema::create('gym_schedule', function (Blueprint $table) {
            $table->id();
            $table->string('hours_From');
            $table->string('hours_To');
            $table->foreignId('days_of_week_id')->references('id')->on('days_of_week')->cascadeOnDelete();
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
        Schema::dropIfExists('gym_schedule');
    }
};
