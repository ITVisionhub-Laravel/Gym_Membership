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
        CREATE OR REPLACE VIEW profit_sharing_view AS
        SELECT
            ROW_NUMBER() OVER () AS Member,
            debit_and_credits.amount AS Revenue_Amount,
            CAST(CalculateFSAProfit(debit_and_credits.amount, 75) AS UNSIGNED) AS FSA_75_percent,
            CAST(CalculateYUFCProfit(debit_and_credits.amount, 25) AS UNSIGNED) AS YUFC_25_percent,
            debit_and_credits.date AS Date
        FROM debit_and_credits
        WHERE debit_and_credits.transaction_type_id = 1 AND debit_and_credits.status_id = 1 AND debit_and_credits.related_info_type = "Member"
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS profit_sharing_view');
    }
};
