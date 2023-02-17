<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class PrintController extends Controller
{
    public function print($attendent)
    { 
        $filter_date = Carbon::parse($attendent)->format('Y-m-d');
        $attendents = Attendent::whereDate('attendent_date' ,$filter_date)->get();
        return view('admin.attendent.print', compact('attendents'));
    }
}
