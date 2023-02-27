<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GymClass;
use App\Models\Logo;
use App\Models\Partner;
use App\Models\Trainer;

class FrontendController extends Controller
{
    public function index()
    {
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['class']=GymClass::get();
        $data['trainer']=Trainer::get();
        return view('frontend.index', $data);
    }
}
