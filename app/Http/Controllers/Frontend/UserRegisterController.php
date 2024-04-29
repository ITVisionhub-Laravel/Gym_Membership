<?php

namespace App\Http\Controllers\Frontend;

use App\Models\City;
use App\Models\Logo;
use App\Models\Address;
use App\Models\GymClass;
use App\Models\CustomerQRCode;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductPaymentRecords;
use App\Http\Requests\CustomerFormRequest;
use App\Http\Requests\UserAddressRequest;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\Street;
use App\Models\Township;
use App\Models\Ward;
use Illuminate\Validation\ValidationException;

class UserRegisterController extends Controller
{
    public function index()
    {

        $data['gymclasses'] = GymClass::get();
        $data['userinfo'] = Auth::user();
        $data['oldGymClassId'] = $data['userinfo']->gym_class_id;
        
        return view('frontend.register.index', $data);
    }

    public function userAddress()
    {
        $data = [
            'countries' => Country::all(),
            'states' => State::all(),
            'cities' => City::all(),
            'townships' => Township::all(),
            'wards' => Ward::all(),
            'streets' => Street::all(),
            'userAddress' => Address::where('user_id', Auth::id())->latest()->first(),
        ];

        $this->setOldValues($data);

        return view('frontend.register.address', $data);
    }

    private function setOldValues(&$data)
    {
        $userAddress = $data['userAddress'];

        $data['oldCountryId'] = $userAddress->street->ward->township->city->state->country->id ?? null;
        $data['oldStateId'] = $userAddress->street->ward->township->city->state->id ?? null;
        $data['oldCityId'] = $userAddress->street->ward->township->city->id ?? null;
        $data['oldTownshipId'] = $userAddress->street->ward->township->id ?? null;
        $data['oldWardId'] = $userAddress->street->ward->id ?? null;
        $data['oldStreetId'] = $userAddress->street->id ?? null;
    }
    public function createQRCode(CustomerFormRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::user();

        try {
            DB::beginTransaction();

            $user->update([
                'age' => $validatedData['age'],
                'gender' => $validatedData['gender'],
                'member_card' => time(),
                'height' => $validatedData['height'],
                'weight' => $validatedData['weight'],
                'gym_class_id' => $validatedData['gym_class_id'],
                'phone_number' => $validatedData['phone_number'],
                'emergency_phone' => $validatedData['emergency_phone'],
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('uploads/customer/', $filename);
                $user->image = $filename;
            }

            $user->save();

            DB::commit();

            return redirect()->route('user.details')->with('message', 'Registered Information Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }
    public function createUserAddress(UserAddressRequest $request, Address $address)
    {
        try {
            $address->fill([
                'user_id' => Auth::user()->id,
                'street_id' => $request->street_id,
                'block_no' => $request->block_no,
                'floor' => $request->floor,
                'zipcode' => $request->zipcode,
            ]);

            DB::beginTransaction();
            $saved = $address->save();

            if ($saved) {
                DB::commit();
                return redirect()->route('user.details')->with('message', 'User Address Information Successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
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
            // dd(Auth::user()->role_as);
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

    public function userDetails()
    {
        $userId = Auth::id();
        
        $userDetailsData = User::where('id',$userId)->first();
        $userAddressDatas = Address::where('user_id', $userId)->latest()->first();

        return view('frontend.user.details', ['userDetailsData' => $userDetailsData, 'userAddressData' => $userAddressDatas]);
    }
}
