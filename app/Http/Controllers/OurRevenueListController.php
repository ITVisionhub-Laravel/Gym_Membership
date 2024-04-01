<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitAndCredit;
use App\Models\ProfitSharingView;
use Illuminate\Support\Facades\Config;

class OurRevenueListController extends Controller
{
    public function index(){ 
        $variablesTwoData = Config::get('variables.TWO'); 
        $data['ourIncome'] = ProfitSharingView::first()->FSA_75_percent;
        $yearlyData = DebitAndCredit::whereYear('date', '=', now()->year) 
            ->get();

        $data['expenses'] = $yearlyData->where('transaction_type_id', $variablesTwoData)->sum('amount');
        return view('admin.ourrevenueList.index', $data);
    }
}
