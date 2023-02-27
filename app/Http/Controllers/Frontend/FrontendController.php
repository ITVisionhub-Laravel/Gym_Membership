<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\CustomerQRCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Logo;

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
        return view('frontend.index', $data);
    }
}
