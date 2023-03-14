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

class UserRegisterController extends Controller
{
    public function index()
    {
        $data['cities'] = City::get(['name', 'id']);
        // $data['packages'] = PaymentPackage::get();
        // $data['providers'] = PaymentProvider::get();
        $data['gymclasses'] = GymClass::get();
        $data['userinfo'] = Auth::user();
        return view('frontend.register.index', $data);
    }

    public function createQRCode(CustomerFormRequest $request)
    {
        $validatedData = $request->validated();
        $customer = new Customer();
        $address = new Address();

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

        // $customer->save();
        if ($customer->save()) {
            return redirect('/')->with(
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
                $data['logo'] = Logo::first();
                $data['partner'] = Partner::get();
                $data['products'] = Products::get();
                return view('frontend.product_checkout', $data);
            }
        }
    }

    public function showProductInvoice()
    {
        $data['product_invoice_list'] = ProductPaymentRecords::where(
            'customer_id',
            Auth::user()->customers->id
        )

            ->get()
            ->groupBy('created_at')
            ->last();
        return view('frontend.product.invoice', $data);
    }
    public function detail()
    {
        return view('frontend.class-detail');
    }
}
