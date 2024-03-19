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
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('quantity')->after('id');
            $table->double('total')->default(0.0)->after('quantity');
            $table->foreignId('order_id')->constrained()->cascadeOnDelete()->after('total');
            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('total');
            $table->dropColumn('order_id');
            $table->dropColumn('product_id');
        });
    }
};
