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
            $table->integer('age');
            $table->string('member_card');
            $table->string('height');
            $table->string('weight');
            $table->string('phone_number');
            $table->string('emergency_phone'); 
            $table->integer('address_id');
            $table->integer('class_id');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('linkedIn');
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
