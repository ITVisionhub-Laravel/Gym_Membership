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
use App\Models\Country;

class UserRegisterController extends Controller
{
    public function index()
    {
        $data['countries'] = Country::all();
        $data['cities'] = City::get(['name', 'id']);
        $data['gymclasses'] = GymClass::get();
        $data['userinfo'] = Auth::user();
        $data['userAddress'] = Address::where('user_id', Auth::id())->first();
        return view('frontend.register.index', $data);
    }

    public function createQRCode(CustomerFormRequest $request)
    {
        $validatedData = $request->validated();
        $customer = User::find(Auth::user()->id);
        $address = new Address();

        // DB::beginTransaction();
        // try {
            $customer->age = $validatedData['age'];
            $customer->gender = $validatedData['gender'];
            $customer->member_card = time();
            $customer->height = $validatedData['height'];
            $customer->weight = $validatedData['weight'];
            $customer->gym_class_id = $validatedData['gym_class_id'];
            $customer->phone_number = $validatedData['phone_number'];
            $customer->emergency_phone = $validatedData['emergency_phone'];

            $address->user_id = Auth::user()->id;
            $address->street_id = $request->street_id;
            $address->block_no = $request->block_no;
            $address->floor = $request->floor;
            $address->zipcode = $request->zipcode;
            $address->save();

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
        //     DB::commit();
        // } catch (Exception $e) {
        //     DB::rollback();
        //     dd($e);
        // }
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
                $gymClassCategoryId = request()->classCategoryId;
                // if (Customer::find(Auth::user()->email)) {
                return view('frontend.package-details', compact('gymClassCategoryId'));
                // } else {
                //     return redirect('/');
                // }
            }
        }
    }
    // public function showproduct()
    // {
    //     if (Auth::user()) {
    //         if (Auth::user()->role_as == 1) {
    //             return redirect('admin/customers');
    //         } else {
    //             // if (Customer::find(Auth::user()->email)) {
    //             //     $data['customer'] = Customer::where(
    //             //         'email',
    //             //         Auth::user()->email
    //             //     )->first();
    //             // }
    //             // $data['customer'] = false;
    //             // $data['logo'] = Logo::first();
    //             // $data['partner'] = Partner::get();
    //             // $data['products'] = Products::get();
    //             // $data['shops'] = Shop::get();
    //             return view('frontend.product_checkout');
    //         }
    //     }
    // }

    public function showGymClassDetails(){
        $gymclassId = request()->gymclassId;
        $gymClassInfo = GymClass::find($gymclassId);
        return view('frontend.gymclass.gymclass-detail',['gymClassInfo' => $gymClassInfo]);
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
    // public function detail()
    // {
    //     $gymClassCategoryId = request()->classCategoryId;
    //     // $gymClasses = GymClass::where('gym_class_category_id', $classCategoryId)->get();
    //     // $gymClassType = $gymClasses->first()->category->name;
    //     return view('frontend.class-detail', compact('gymClassCategoryId'));
    // }

    public function userDetails(){

        return view('frontend.user.details');
    }
}
