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
        Schema::table('delivery_request', function (Blueprint $table) {
            $table
                ->integer('status')
                ->default('0')
                ->comment('1=approved,0=pending,3=finished');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_request', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
