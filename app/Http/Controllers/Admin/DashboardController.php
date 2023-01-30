<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendent;
use App\Models\Customer;
use App\Models\PaymentRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $data['attendencedMembers'] = Attendent::where('status', '1')->get();
        $data['members'] = Customer::get();
        $prices = 0;
        foreach (PaymentRecord::get() as $paymentPrice) {
            $prices += (int) $paymentPrice->price;
        }
        $data['price'] = $prices;
        $data['paymentRecords'] = PaymentRecord::get();

        return view('admin.dashboard.index', $data);
    }
    public function create()
    {
        return view('admin.dashboard.create');
    }

    public function barchart(Request $request)
    {
    }
}
