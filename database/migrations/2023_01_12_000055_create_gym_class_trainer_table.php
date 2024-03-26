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
        Schema::create('gym_class_trainer', function (Blueprint $table) {
            $table->id();
            $table->foreignId("gym_class_id")->references('id')->on('gym_classes')->onDelete('cascade');
            $table->foreignId("schedule_id")->references('id')->on('gym_schedule')->onDelete('cascade');
            $table->foreignId("trainer_id")->references('id')->on('trainers')->onDelete('cascade');
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
        Schema::dropIfExists('gym_class_trainer');
    }
};
