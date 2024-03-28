<?php

namespace App\Http\Controllers\Frontend;

use App\Models\City;
use App\Models\Logo;
use App\Models\Address;
use App\Models\Partner;
use App\Models\Customer;
use App\Models\GymClass;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\Models\CustomerQRCode;
use App\Models\PaymentPackage;
use App\Models\PaymentProvider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductPaymentRecords;   
use App\Http\Requests\CustomerFormRequest;
use App\Models\Shop;
use App\Models\User;

class UserRegisterController extends Controller
{
    public function index()
    {
        $data['cities'] = City::get(['name', 'id']);
        $data['gymclasses'] = GymClass::get();
        $data['userinfo'] = Auth::user();
        return view('frontend.register.index', $data);
    }

    public function createQRCode(CustomerFormRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $customer = User::find(Auth::user()->id);
        $address = new Address();

        // $customer->name = $validatedData['name'];
        // $customer->email = $validatedData['email'];
        $customer->age = $validatedData['age'];
        $customer->member_card = time();
        $customer->height = $validatedData['height'];
        $customer->weight = $validatedData['weight'];
        $customer->class_id = $validatedData['gymclass'];
        $customer->phone_number = $validatedData['phone_number'];
        $customer->emergency_phone = $validatedData['emergency_phone'];

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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/customer/', $filename);
            $customer->image = $filename;
        }

        if ($customer->save()) {
            return redirect(route('user.details'))->with(
                'message',
                'Registered Information Successfully'
            );
        }
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
        if (Auth::user()) {
            if (Auth::user()->role_as == 1) {
                return redirect('admin/customers');
            } else {
                // if (Customer::find(Auth::user()->email)) {
                return view('frontend.package-details');
                // } else {
                //     return redirect('/');
                // }
            }
        }
    }
    public function showproduct()
    {
        if (Auth::user()) {
            if (Auth::user()->role_as == 1) {
                return redirect('admin/customers');
            } else {
                // if (Customer::find(Auth::user()->email)) {
                //     $data['customer'] = Customer::where(
                //         'email',
                //         Auth::user()->email
                //     )->first();
                // }
                // $data['customer'] = false;
                // $data['logo'] = Logo::first();
                // $data['partner'] = Partner::get();
                // $data['products'] = Products::get();
                // $data['shops'] = Shop::get();
                return view('frontend.product_checkout');
            }
        }
    }

    public function showProductInvoice()
    {
        $logos = Logo::first();
        $checkoutProducts = ProductPaymentRecords::where(
            'user_id',
            auth()->user()->id
        )
            ->get()
            ->groupBy('created_at')
            ->last();
        $total = ProductPaymentRecords::get()
            ->where('user_id', auth()->user()->id)
            ->groupBy('created_at')
            ->last()
            ->sum('total');
        return view(
            'frontend.product.invoice',
            compact('checkoutProducts', 'total', 'logos')
        );
    }
    public function detail($classCategoryId)
    {
        $gymClasses = GymClass::where('gym_class_category_id', $classCategoryId)->get();
        $gymClassType = $gymClasses->first()->category->name;
        return view('frontend.class-detail', compact('gymClasses', 'gymClassType'));
    }

    public function userDetails(){

        return view('frontend.user.details');
    }
}
