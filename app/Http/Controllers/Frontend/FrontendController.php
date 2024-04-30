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
        dd(Auth::user());
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['gymClasses'] = GymClass::get();
        $data['days_of_week'] = DaysOfWeek::get();
        $data['class_categories'] = GymClassCategory::get();
        $data['gymTrainers'] = Trainer::get();
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

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|recaptcha'
        ];

        $this->validate($request,$rules,[
            'name.required' => 'User Name is required',
            'email.required' => 'Email is required',
            'subject.required' => 'Subject is required',
            'message.required' => 'You have to put some message',
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => "Please complete the captcha"
        ]);


    }
}
