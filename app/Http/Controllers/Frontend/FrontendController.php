<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\CustomerQRCode;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\GymClass;
use Illuminate\Support\Facades\Auth;
use App\Models\Logo;
use App\Models\Partner;
use App\Models\Trainer;

class FrontendController extends Controller
{
    public function index()
    {
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['class'] = GymClass::get();
        $data['trainer'] = Trainer::get();
        if (Auth::user()) {
            if (Auth::user()->role_as == 1) {
                return redirect('admin/customers');
            } else {
                $member_card_id = Customer::where(
                    'email',
                    Auth::user()->email
                )->first();

                if ($member_card_id) {
                    $member = CustomerQRCode::where(
                        'member_card_id',
                        $member_card_id->member_card
                    )->first();

                    if ($member->user_id == 0) {
                        CustomerQRCode::where(
                            'member_card_id',
                            $member_card_id->member_card
                        )->update(['user_id' => Auth::user()->id]);
                        $data['qrcode'] = CustomerQRCode::where(
                            'member_card_id',
                            $member_card_id->member_card
                        )->first();
                    } else {
                        $data['qrcode'] = $member;
                    }
                } else {
                    $data['qrcode'] = false;
                }
                return view('frontend.index', $data);
            }
        } else {
            $data['qrcode'] = false;
            return view('frontend.index', $data);
        }
    }
}
