<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE FUNCTION CheckMembershipStatus(record_date DATE, package VARCHAR(255)) RETURNS VARCHAR(50)
            DETERMINISTIC
            BEGIN
                DECLARE expiry_date DATE;
                DECLARE diff_days INT;
                DECLARE status VARCHAR(50);

                -- Calculate expiry date based on package type
                IF package LIKE '%month%' THEN
                    SET expiry_date = DATE_ADD(record_date, INTERVAL CAST(SUBSTRING_INDEX(package, 'month', 1) AS SIGNED) MONTH);
                ELSEIF package LIKE '%week%' THEN
                    SET expiry_date = DATE_ADD(record_date, INTERVAL CAST(SUBSTRING_INDEX(package, 'week', 1) AS SIGNED) WEEK);
                ELSEIF package LIKE '%year%' THEN
                    SET expiry_date = DATE_ADD(record_date, INTERVAL CAST(SUBSTRING_INDEX(package, 'year', 1) AS SIGNED) YEAR);
                ELSE
                    SET expiry_date = DATE_ADD(record_date, INTERVAL CAST(SUBSTRING_INDEX(package, 'week', 1) AS SIGNED) WEEK);
                END IF;

                -- Calculate the difference in days between expiry date and current date
                SET diff_days = DATEDIFF(expiry_date, CURDATE());

                -- Determine membership status
                IF diff_days <= 3 THEN
                    SET status = 'Expired';
                ELSE
                    SET status = 'Not Expired';
                END IF;

                RETURN status;
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_staff_salary_view');
    }
};
