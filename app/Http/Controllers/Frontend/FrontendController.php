<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\CustomerQRCode;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DaysOfWeek;
use App\Models\GymClass;
use App\Models\GymClassCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\Logo;
use App\Models\Partner;
use App\Models\Trainer;
use App\Models\User;

class FrontendController extends Controller
{
    public function index()
    {
        // dd(isset(Auth::user()->member_card));
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['class'] = GymClass::get();
        $data['days_of_week'] = DaysOfWeek::get();
        $data['class_categories'] = GymClassCategory::get();
        $data['trainer'] = Trainer::get();
        if (Auth::user()) {
            if (Auth::user()->role_as == 1) {
                return redirect('admin/customers');
            } else {
                // $customer = false;

                // if ($member_card_id) {
                //     $member = CustomerQRCode::where(
                //         'member_card_id',
                //         $member_card_id->member_card
                //     )->first();

                //     if ($member->user_id == 0) {
                //         CustomerQRCode::where(
                //             'member_card_id',
                //             $member_card_id->member_card
                //         )->update(['user_id' => Auth::user()->id]);
                //         $data['qrcode'] = CustomerQRCode::where(
                //             'member_card_id',
                //             $member_card_id->member_card
                //         )->first();
                //     } else {
                // $data['qrcode'] = $member;
                // }
                // } else {
                $data['customer'] = isset(Auth::user()->member_card);
                // }
                return view('frontend.index', $data);
            }
        } else {
            $data['customer'] = false;
            return view('frontend.index', $data);
        }
    }
}
