<?php

namespace App\Console\Commands;

use Exception;
use Carbon\Carbon;
use App\Models\Expenses;
use App\Models\DebitAndCredit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;


class CalculateTotalSalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'app:calculate_total_salary';
    public $payingSalary;

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Calculate and store total salary';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $StaffID = Config::get('variables.STAFFID');
        $totalSalary = DB::select(DB::raw("SELECT calculate_total_salary($StaffID)"));

        // Convert the array to a string representation
        $totalSalaryString = json_encode($totalSalary);

        // Decode the JSON string back to an array
        $totalSalaryArray = json_decode($totalSalaryString, true);

        // Extract the value from the array
        $totalSalaryValue = $totalSalaryArray[0]['calculate_total_salary(2)'];

        // Calculate start date and end date
        $startDate = Carbon::now()->format('Y-m-d');

        DB::beginTransaction();
        try { 
            $this->payingSalary = Expenses::create([
                'name' => 'Paying Salary to all of the Staff',
                'amount' => $totalSalaryValue,
                'invoice_slip' => '',
                'invoice_id' => '',
                'created_at' => $startDate,
                'updated_at' => $startDate
            ]); 

            $this->debitCreditInfos($startDate);
            DB::commit(); 
        } catch (Exception $e) {
            DB::rollback(); 
        }

        return 0;
    }

    public function debitCreditInfos($startDate)
    {
        // /Log::info(Config::get('variables.EXPENSES'));
        

        try {
            // Attempt to create the DebitAndCredit model
            $test = DebitAndCredit::create([
                'name' => $this->payingSalary->name,
                'amount' => $this->payingSalary->amount,
                'status_id' => Config::get('variables.SUCCESS'),
                'date' => $startDate,
                'related_info_id' => 0,
                'related_info_type' => Config::get('variables.EXPENSES'),
                'transaction_type_id' => Config::get('variables.CREDIT'),
                'created_at' => $startDate,
                'updated_at' => $startDate
            ]);
            // Log the created model
            Log::info($test);
        } catch (Exception $e) {
            // Handle the exception
            Log::error('Error creating DebitAndCredit model: '.$e->getMessage());
        }

    }


}
