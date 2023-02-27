<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\CustomerQRCode;
use App\Http\Controllers\Controller;
use App\Models\GymClass;
use Illuminate\Support\Facades\Auth;
use App\Models\Logo;
use App\Models\Partner;
use App\Models\Trainer;

class FrontendController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $data['qrcode'] = CustomerQRCode::where(
                'user_id',
                Auth::user()->id
            )->first();
        } else {
            $data['qrcode'] = false;
        }

        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['class']=GymClass::get();
        $data['trainer']=Trainer::get();
        return view('frontend.index', $data);
    }
}
