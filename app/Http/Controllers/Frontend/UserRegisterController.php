<?php

namespace App\Http\Controllers\Frontend;

use App\Models\City;
use App\Models\Logo;
use App\Models\Partner;
use App\Models\Address;
use App\Models\Customer;
use App\Models\GymClass;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\Models\PaymentPackage;
use App\Models\PaymentProvider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CustomerQRCode;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends Controller
{
    public function index()
    {
        $data['cities'] = City::get(['name', 'id']);
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();
        $data['gymclasses'] = GymClass::get();
        $data['userinfo'] = Auth::user();
        return view('frontend.register.index', $data);
    }

    public function createQRCode(Request $request)
    {
        // @dd($request->name);
        $customer = new Customer();
        $address = new Address();
        $payment_record = new PaymentRecord();

        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'email' => ['required', 'string'],
            'height' => ['required', 'string'],
            'weight' => ['required', 'string'],
            'city' => ['required', 'string'],
            'township' => ['required', 'string'],
            'street' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'emergency_phone' => ['required', 'string'],
            'package' => ['required', 'string'],
            'promotion' => ['required', 'string'],
            'original_price' => ['required', 'string'],
            'price' => ['required', 'string'],
            'payment' => ['required', 'string'],
            'gymclass' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'bank_slip' => ['nullable', 'mimes:jpg,jpeg,png'],
        ]);

        $customer->name = $validatedData['name'];
        $customer->age = $validatedData['age'];
        $customer->email = $validatedData['email'];
        $customer->member_card = time();
        $customer->height = $validatedData['height'];
        $customer->weight = $validatedData['weight'];
        $customer->class_id = $validatedData['gymclass'];

        if (
            DB::table('addresses')
                ->where('street_id', $request->street)
                ->exists()
        ) {
            $addressField = Address::where(
                'street_id',
                $request->street
            )->get();
            $customer->address_id = $addressField[0]->id;
            // dd($addressField);
        } else {
            $address->street_id = $request->street;
            $address->save();
            $addressField = Address::where(
                'street_id',
                $request->street
            )->get();
            $customer->address_id = $addressField[0]->id;
        }

        $customer->phone_number = $validatedData['phone_number'];
        $customer->emergency_phone = $validatedData['emergency_phone'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/customer/', $filename);
            $customer->image = $filename;
        }

        if ($customer->save()) {
            if ($request->hasFile('bank_slip')) {
                $file = $request->file('bank_slip');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('uploads/bankslip/', $filename);
                $payment_record->bank_slip = $filename;
            }
            $package_info = explode(' ', $request->package);
            $payment_record->package_id = $package_info[0];
            $payment_record->price = $request->price;
            $payment_record->record_date = date('Y.m.d');
            $payment_record->provider_id = $request->payment;
            $payment_record->customer_id = $customer->id;
            if (!$payment_record->save()) {
                $customer->delete();
            } else {
                if ($payment_record->save()) {
                    $customerQRCode = new CustomerQRCode();
                    $customerQRCode->member_card_id = $customer->member_card;
                    $customerQRCode->user_id = Auth::user()->id;
                    if ($customerQRCode->save()) {
                        return redirect('/')->with(
                            'message',
                            'Customer QRCode Generated Successfully'
                        );
                    } else {
                        $customer->delete();
                        $payment_record->delete();
                    }
                }
            }
        }

        // $data['member_card'] = $customer->member_card;
    }

    public function showQRCode()
    {
        $data['qrcode'] = CustomerQRCode::where(
            'user_id',
            Auth::user()->id
        )->first();
        return view('frontend.register.qrcode', $data);
    }
    public function show()
    {
        $data['qrcode'] = CustomerQRCode::where(
            'user_id',
            Auth::user()->id
        )->first();
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['products'] = Products::get();
        return view('frontend.package-details', $data);
    }
    public function detail()
    {
        return view('frontend.class-detail');
    }
}
