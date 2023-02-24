<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logo;

class FrontendController extends Controller
{
    public function index()
    {
        $data['logo'] = Logo::first();
        return view('frontend.index', $data);
    }
}
