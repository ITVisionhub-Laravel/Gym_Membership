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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->string('member_card')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->integer('address_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedIn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->dropColumn('member_card');
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('phone_number');
            $table->dropColumn('emergency_phone');
            $table->dropColumn('address_id');
            $table->dropColumn('class_id');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('linkedIn');
        });
    }
};
