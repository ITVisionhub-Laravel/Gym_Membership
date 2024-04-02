<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Models\DebitAndCredit;
use App\Models\ProfitSharingView;
use App\Traits\FilterByDatesTrait;
use Illuminate\Support\Facades\Log;
use App\Traits\FilterableByDatesTrait;
use Illuminate\Support\Facades\Config;

class OurRevenueListController extends Controller
{
    use FilterableByDatesTrait;
    public function index()
    {
        $variablesTwoData = Config::get('variables.TWO');
        // $this->filteringOurIncome();
        // $this->filteringOurExpenses();

        $yearlyData = DebitAndCredit::whereYear('date', '=', now()->year)->get();
        $data['ourIncome'] = ProfitSharingView::sum('FSA_75_percent');
        $data['expenses'] = $yearlyData->where('transaction_type_id', $variablesTwoData)->sum('amount');
        return view('admin.ourrevenueList.index', $data);
    }

    public function filteringOurExpenses()
    {
        $allOurExpenses = Expenses::get();

        // Initialize an array to store data for each month
        $monthlyOurExpensesDatas = [];

        // Loop through the retrieved data
        foreach ($allOurExpenses as $ourExpenses) {
            $date = $ourExpenses->created_at;
            $month = date("F", strtotime($date)); // Get the month name

            // Initialize the array for the current month if it doesn't exist
            if (!isset($monthlyOurExpensesDatas[$month])) {
                $monthlyOurExpensesDatas[$month] = [];
            }

            // Add the current entry to the array for the current month
            $monthlyOurExpensesDatas[$month][] = $ourExpenses;
        }

        // Initialize an array to store the sum of amounts for each month
        $monthlyExpenses = [];

        // Calculate the sum of amounts for each month
        foreach ($monthlyOurExpensesDatas as $month => $monthlyExpensesData) {
            $sum = 0;
            foreach ($monthlyExpensesData as $monthlyOurExpense) {
                $sum += $monthlyOurExpense->amount; // Assuming "amount" is the column name in your database
            }
            $monthlyExpenses[$month] = $sum;
        }
        dd($monthlyExpenses);
    }


    // $data['ourIncome'] = ProfitSharingView::get();

    // // Initialize an array to store data for each month
    // $monthlyIncomeDatas = [];

    // // Loop through the retrieved data
    // foreach ($data['ourIncome'] as $ourIncome) {
    //     $date = $ourIncome->Date; // Assuming "Date" is the column name in your database
    //     $month = date("F", strtotime($date)); // Get the month name

    //     // Initialize the array for the current month if it doesn't exist
    //     if (!isset($monthlyIncomeDatas[$month])) {
    //         $monthlyIncomeDatas[$month] = [];
    //     }

    //     // Add the current entry to the array for the current month
    //     $monthlyIncomeDatas[$month][] = $ourIncome;
    // }

    // // Initialize an array to store the sum of amounts for each month
    // $monthlyIncome = [];

    // // Calculate the sum of amounts for each month
    // foreach ($monthlyIncomeDatas as $month => $monthlyIncomeData) {
    //     $sum = 0;
    //     foreach ($monthlyIncomeData as $monthlyOurIncome) {
    //         $sum += $monthlyOurIncome->FSA_75_percent; // Assuming "FSA_75_percent" is the column name for the amount in your database
    //     }
    //     $monthlyIncome[$month] = $sum;
    // }
    public function filteringOurIncome(Request $request)
    { 
        $dataType = $request->data_type; 
        // return response()->json($dataType);
        
        $ourIncome = 0;
        $ourExpense = 0;
        $date = "";

        try {
            // daily_profit

            switch ($dataType) {
                case "daily":
                    $ourIncome = ProfitSharingView::dailyData('Date')->get()->sum('FSA_75_percent');
                    $ourExpense = Expenses::dailyData()->get()->sum('amount');
                    $date = "From " . Carbon::now()->startOfDay()->toDateString() . " To " . Carbon::now()->endOfDay()->toDateString();
                    break;

                case "weekly":
                    $ourIncome = ProfitSharingView::last7Days('Date')->get()->sum('FSA_75_percent');
                    $ourExpense = Expenses::last7Days()->get()->sum('amount');
                    $date = "From " . Carbon::today()->subDays(6)->toDateString() . " To " .  Carbon::now()->toDateString();
                    break;

                case "monthly":
                    $ourIncome = ProfitSharingView::monthToDate('Date')->get()->sum('FSA_75_percent');
                    $ourExpense = Expenses::monthToDate()->get()->sum('amount');
                    $date = "From " . Carbon::now()->startOfMonth()->toDateString() . " To " .  Carbon::now()->toDateString();
                    break;

                case "yearly":
                    $ourIncome = ProfitSharingView::lastYear('Date')->get()->sum('FSA_75_percent');
                    $ourExpense = Expenses::lastYear()->get()->sum('amount');
                    $date = "From " . Carbon::now()->subYear()->toDateString() . " To " .  Carbon::now()->toDateString();
                    break;

                default:
                    // Handle default case here
                    break;
            }

            

            $data = [
                'income' => $ourIncome,
                'expense' => $ourExpense,
                'date' => $date 
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            // Log the error for further investigation
            Log::error('Error fetching data: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

}

