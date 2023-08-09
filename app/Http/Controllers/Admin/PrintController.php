<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class PrintController extends Controller
{
    public function print(Request $request)
    {
        dd($request->input('date'));
        // $filter_date = Carbon::parse()->format('Y-m-d');
        // $attendents = Attendent::whereDate(
        //     'attendent_date',
        //     $filter_date
        // )->get();
        // return view('admin.attendent.print', compact('attendents'));
        // Get the filter date from the request or use the current date as default
        $filter_date = $request->input('date', Carbon::now()->format('Y-m-d'));

        // Fetch the attendants based on the filter date
        $attendents = Attendent::whereDate(
            'attendent_date',
            $filter_date
        )->get();

        return view(
            'admin.attendent.print',
            compact('attendents', 'filter_date')
        );
    }
}
