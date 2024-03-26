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
                COUNT(payment_records.id) AS Member,
                CAST(SUM(payment_packages.promotion_price) AS UNSIGNED) AS Revenue_Amount,
                CAST(CalculateFSAProfit(SUM(payment_packages.promotion_price),75) AS UNSIGNED) AS FSA_75_percent,
                CAST(CalculateYUFCProfit(SUM(payment_packages.promotion_price),25) AS UNSIGNED) AS YUFC_25_percent
            FROM payment_records
            INNER JOIN payment_packages ON payment_records.payment_package_id = payment_packages.id
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
