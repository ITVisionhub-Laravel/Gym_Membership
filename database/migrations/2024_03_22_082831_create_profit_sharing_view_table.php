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
        DB::statement('
            CREATE VIEW profit_sharing_view AS
            SELECT
                COUNT(id) AS Member,
                CAST(SUM(price) AS UNSIGNED) AS Revenue_Amount,
                CAST(CalculateFSAProfit(SUM(price),75) AS UNSIGNED) AS FSA_75_percent,
                CAST(CalculateYUFCProfit(SUM(price),25) AS UNSIGNED) AS YUFC_25_percent
            FROM payment_records
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW profit_sharing_view');
    }
};
