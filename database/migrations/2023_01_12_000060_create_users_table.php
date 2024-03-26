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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('role_as')->default('0')->comment('0=user,1=admin');
            $table->foreignId('position_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('reporting_to')->nullable();
            $table->string('image')->nullable()->default('sample.png');
            $table->integer('age')->nullable();
            $table->string('member_card')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->foreignId('gym_class_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedIn')->nullable();
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
        Schema::dropIfExists('users');
    }
};
