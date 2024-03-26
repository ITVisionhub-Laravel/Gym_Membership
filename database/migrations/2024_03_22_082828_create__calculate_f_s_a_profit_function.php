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
        DB::unprepared('

        CREATE FUNCTION CalculateFSAProfit(amount INT,percentage INT)
        RETURNS INT
        BEGIN
            DECLARE getAmount INT;
            SET getAmount = amount * (percentage / 100);
            RETURN getAmount;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_calculate_f_s_a_profit_function');
    }
};
