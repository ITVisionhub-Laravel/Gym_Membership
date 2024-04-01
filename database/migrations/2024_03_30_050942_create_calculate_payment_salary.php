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
        DB::unprepared('

        CREATE FUNCTION calculate_total_salary(role_id INT) RETURNS DECIMAL(10, 2)
        BEGIN
            DECLARE total_salary DECIMAL(10, 2);
            
            SELECT SUM(s.amount) INTO total_salary
            FROM users u
            JOIN salaries s ON u.salary_id = s.id
            WHERE u.role_as = role_id;

            RETURN total_salary;
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
        Schema::dropIfExists('calculate_payment_salary');
    }
};
