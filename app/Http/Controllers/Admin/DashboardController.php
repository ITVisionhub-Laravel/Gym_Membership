<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendent;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $attendencedMembers = Attendent::where('status', '1')->get();

        $members = Customer::get();

        return view(
            'admin.dashboard.index',
            compact('attendencedMembers', 'members')
        );
    }
    public function create()
    {
        return view('admin.dashboard.create');
    }

    public function barchart(Request $request)
    {
    }
}
