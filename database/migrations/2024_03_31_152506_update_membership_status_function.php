<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class UpdateMembershipStatusFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
CREATE FUNCTION UpdateMembershipStatus(member_id INT) RETURNS INT
BEGIN
    DECLARE record_date DATE;
    DECLARE package_name VARCHAR(255);
    DECLARE status VARCHAR(50);

    -- Fetch required data
    SELECT dc.date, pp.package INTO record_date, package_name
    FROM debit_and_credits dc
    JOIN users u ON dc.related_info_id = u.member_card     
    JOIN payment_records pr ON pr.user_id = u.id
    JOIN payment_packages pp ON pp.id = pr.payment_package_id
    WHERE dc.related_info_type = 'member'
    AND dc.status_id = 1
    AND u.member_card = member_id;

    -- Call CheckMembershipStatus function with fetched data
    SET status = CheckMembershipStatus(record_date, package_name);

    -- Update users table with membership_status
    UPDATE users SET membership_status = status WHERE member_card = member_id;

    -- Return a placeholder value
    RETURN 0;
END;
SQL;

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the function if needed
        DB::unprepared('DROP FUNCTION IF EXISTS UpdateMembershipStatus');
    }
}


