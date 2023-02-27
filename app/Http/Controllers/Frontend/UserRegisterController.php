<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Logo;
use App\Models\Partner;
use App\Models\PaymentPackage;
use App\Models\PaymentProvider;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function index()
    {
        $data['cities'] = City::get(['name', 'id']);
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();
        return view('frontend.register.index',$data);
    }
    public function show()
    {
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        return view('frontend.package-details',$data);
    }
}
