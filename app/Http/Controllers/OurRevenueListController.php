<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitAndCredit;
use App\Models\Expenses;
use App\Models\ProfitSharingView;
use Illuminate\Support\Facades\Config;

class OurRevenueListController extends Controller
{
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

    public function filteringOurIncome()
    {
        $data['ourIncome'] = ProfitSharingView::get();

        // Initialize an array to store data for each month
        $monthlyIncomeDatas = [];

        // Loop through the retrieved data
        foreach ($data['ourIncome'] as $ourIncome) {
            $date = $ourIncome->Date; // Assuming "Date" is the column name in your database
            $month = date("F", strtotime($date)); // Get the month name

            // Initialize the array for the current month if it doesn't exist
            if (!isset($monthlyIncomeDatas[$month])) {
                $monthlyIncomeDatas[$month] = [];
            }

            // Add the current entry to the array for the current month
            $monthlyIncomeDatas[$month][] = $ourIncome;
        }

        // Initialize an array to store the sum of amounts for each month
        $monthlyIncome = [];

        // Calculate the sum of amounts for each month
        foreach ($monthlyIncomeDatas as $month => $monthlyIncomeData) {
            $sum = 0;
            foreach ($monthlyIncomeData as $monthlyOurIncome) {
                $sum += $monthlyOurIncome->FSA_75_percent; // Assuming "FSA_75_percent" is the column name for the amount in your database
            }
            $monthlyIncome[$month] = $sum;
        }

        // Return the array containing the sums of amounts for each month
        return response()->json($monthlyIncome);
    }

}

