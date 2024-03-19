<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // Schema::table('payment_records', function (Blueprint $table) {
        //     $table->renameColumn('customer_id', 'user_id');
        // });
        DB::statement('ALTER TABLE payment_records CHANGE COLUMN customer_id user_id INT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('payment_records', function (Blueprint $table) {
        //     $table->renameColumn('user_id', 'customer_id');
        // });
        DB::statement('ALTER TABLE payment_records CHANGE COLUMN user_id customer_id INT');
    }
};
