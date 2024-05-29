<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\City;
use App\Models\Logo;
use App\Models\User;
use App\Models\Ward;
use App\Models\State;
use App\Models\Street;
use App\Models\Address;
use App\Models\Country;
use App\Models\GymClass;
use App\Models\Township;
use Illuminate\Http\Request;
use App\Mail\InvoiceMailable;
use App\Models\PaymentRecord;
use App\Models\PaymentPackage;
use Illuminate\Support\Carbon;
use App\Models\PaymentProvider;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\UploadImageTrait;
use FontLib\TrueType\Collection;
use App\Models\ProfitSharingView;
use App\Contracts\MemberInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Resources\CityResource;
use App\Http\Resources\WardResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\StateResource;
use App\Models\PaymentExpiredMembers;
use App\Models\ProductPaymentRecords;
use App\Http\Resources\MemberResource;
use App\Http\Resources\StreetResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\TownshipResource;
use App\Http\Requests\CustomerFormRequest;
use App\Http\Resources\EditMemberResource;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Resources\SearchMemberResource;
use App\Http\Resources\MemberHistoryResource;
use App\Http\Resources\PaymentExpiredMemberResource;

class MemberController extends Controller
{
    private $memberInterface;
    public $addressDataKeys = [
            'street_id', 'block_no', 'floor', 'zipcode'
        ];

    public function __construct(MemberInterface $memberInterface)
    {
        $this->memberInterface = $memberInterface;
    }

    public function searchMember(Request $request)
    {
        if ($request->has('search') && !empty($request->input('search'))) {
            $query = User::with('address')->where('role_as', 0);
            $searchKey = $request->input('search');

            $data = $query->where(function ($query) use ($searchKey) {
                $query->where('name', 'like', "%{$searchKey}%")
                    ->orWhere('age', 'like', "%{$searchKey}%")
                    ->orWhere('gender', 'like', "%{$searchKey}%")
                    ->orWhere('height', 'like', "%{$searchKey}%")
                    ->orWhere('weight', 'like', "%{$searchKey}%")
                    ->orWhere('phone_number', 'like', "%{$searchKey}%")
                    ->orWhere('emergency_phone', 'like', "%{$searchKey}%")
                    ->orWhere('image', 'like', "%{$searchKey}%")
                    ->orWhereHas('address', function ($query) use ($searchKey) {
                        $query->where('floor', 'like', "%{$searchKey}%")
                            ->orWhere('block_no', 'like', "%{$searchKey}%");
                    })
                    ->orWhereHas('address.street', function ($query) use ($searchKey) {
                        $query->where('name', 'like', "%{$searchKey}%");
                    })
                    ->orWhereHas('address.street.ward', function ($query) use ($searchKey) {
                        $query->where('name', 'like', "%{$searchKey}%");
                    })
                    ->orWhereHas('address.street.ward.township', function ($query) use ($searchKey) {
                        $query->where('name', 'like', "%{$searchKey}%");
                    })
                    ->orWhereHas('address.street.ward.township.city', function ($query) use ($searchKey) {
                        $query->where('name', 'like', "%{$searchKey}%");
                    })
                    ->orWhereHas('address.street.ward.township.city.state', function ($query) use ($searchKey) {
                        $query->where('name', 'like', "%{$searchKey}%");
                    })
                    ->orWhereHas('address.street.ward.township.city.state.country', function ($query) use ($searchKey) {
                        $query->where('name', 'like', "%{$searchKey}%");
                    });
            })->paginate(10);

            if (request()->expectsJson()) {
                return SearchMemberResource::collection($data);
            }
        }
    }

    public function index()
    { 
        $customers = $this->memberInterface->all('User');    
        
        if (request()->is('api/*')) { 
            return MemberResource::collection($customers);
        }
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $data = [
            'countries' => Country::all(),
            'states' => State::all(),
            'cities' => City::all(),
            'townships' => Township::all(),
            'wards' => Ward::all(),
            'streets' => Street::all(),
            'packages' => PaymentPackage::get(),
            'providers' => PaymentProvider::get(),
            'gymclasses' => GymClass::get(),
        ];

        return view('admin.customers.create', $data);
    }

    private function splitAddressData(array $data)
    { 
        $addressData = array_intersect_key($data, array_flip($this->addressDataKeys));
        return  $addressData;
    }


    public function store(CustomerFormRequest $request)
    { 
        $validatedData = $request->validated();
        $validatedData['member_card']  = time();
        $validatedData['password']  = Hash::make("password");
        // Split the data
        $addressData = $this->splitAddressData($validatedData);
        $userData = array_diff_key($validatedData, array_flip($this->addressDataKeys));
        
        try {
            DB::beginTransaction();
            $customer = $this->memberInterface->store('User', $userData);
            $addressData['user_id'] = $customer['id'];
            $this->memberInterface->store('Address', $addressData);
            DB::commit();
            if (request()->is('api/*')) {
                return new MemberResource($customer);
            }
            return redirect('admin/customers')->with('message', 'Customer Added Successfully');
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }
        if (request()->expectsJson()) {
            if (!$customer) {
                return response()->json([
                    'message' => 'Member not found'
                ], 401);
            }
            return new MemberResource($customer);
        }
    }
    public function edit(User $customer)
    {
        $data = [
            'countries' => Country::all(),
            'states' => State::all(),
            'cities' => City::all(),
            'townships' => Township::all(),
            'wards' => Ward::all(),
            'streets' => Street::all(),
            'packages' => PaymentPackage::get(),
            'providers' => PaymentProvider::get(),
            'gymclasses' => GymClass::get(),
            'userAddress' => Address::where('user_id', $customer->id)->latest()->first(),
            'oldGymClassId' => $customer->gym_class_id,
        ];
        $data['payment_records'] = PaymentRecord::where(
            'user_id',
            $customer->id
        )->get();
        $this->setOldValues($data);

        if (request()->expectsJson()) {
            return new EditMemberResource($data, $customer);
        }
        return view('admin.customers.edit', $data, compact('customer'));
    }

    public function update(CustomerUpdateRequest $request, $customer)
    {
        $customer = User::findOrFail($customer);
        $address = new Address();
        $validatedData = $request->validated();
        $customer->name = $validatedData['name'];
        $customer->age = $validatedData['age'];
        $customer->gender = $validatedData['gender'];
        $customer->member_card = time();
        $customer->password = bcrypt('00000');
        $customer->gym_class_id = $validatedData['gym_class_id'];
        $customer->height = $validatedData['height'];
        $customer->weight = $validatedData['weight'];
        $customer->phone_number = $validatedData['phone_number'];
        $customer->emergency_phone = $validatedData['emergency_phone'];
        $customer->facebook = $request->facebook;
        $customer->twitter = $request->twitter;
        $customer->linkedIn = $request->linkedIn;
        $this->uploadImage($request, $customer, "member");


        DB::beginTransaction();
        try {
            $customer->update();
            $address->street_id = $request->street_id;
            $address->user_id = $customer->id;
            $address->block_no = $request->block_no;
            $address->floor = $request->floor;
            $address->zipcode = $request->zipcode;
            $address->save();
            DB::commit();

            if (request()->expectsJson()) {
                return new MemberResource($customer);
            }
            return redirect('admin/customers')->with('message', 'Customer Updated Successfully');
        } catch (Exception $e) {
            DB::rollback();
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Failed to update customer, error: ' . $e->getMessage()], 500);
            }
            dd("Exception occurred: " . $e->getMessage());
        }
    }

    public function destroy($customer_id)
    {
        $customer = User::findOrFail($customer_id);
        $this->deleteImage($customer);

        if ($customer->delete()) {
            PaymentRecord::where('user_id', $customer_id)->delete();
            PaymentExpiredMembers::where('user_id', $customer_id)->delete();
        }
        if (request()->expectsJson()) {
            return response()->json([
                'status' => 200,
                'message' => 'City has been deleted successfully',
            ]);
        }
        return redirect('admin/customers')->with(
            'message',
            'Customer Deleted Successfully'
        );
    }


    public function fetchState(String $country_id)
    {
        $data['states'] = State::where(
            'country_id',
            $country_id
        )->get();
        return StateResource::collection($data['states']);
        // return response()->json($data);
    }

    public function fetchCity(String $state_id)
    {
        $data['cities'] = City::where(
            'state_id',
            $state_id
        )->get();
        return CityResource::collection($data['cities']);
        // return response()->json($data);
    }
    public function fetchTownship(String $city_id)
    {
        $data['townships'] = Township::where(
            'city_id',
            $city_id
        )->get();
        return TownshipResource::collection($data['townships']);
    }
    public function fetchWard(String $township_id)
    {
        $data['wards'] = Ward::where(
            'township_id',
            $township_id
        )->get();
        return WardResource::collection($data['wards']);
    }

    public function fetchStreet(String $ward_id)
    {
        $data['streets'] = Street::where(
            'ward_id',
            $ward_id
        )->get();
        return StreetResource::collection($data['streets']);
    }
    public function daily(Request $request)
    {
        if ($request->daily_data == "Daily") {
            $data = [
                'date' => Carbon::today()->toDateString(),
                'daily' => ProfitSharingView::today('Date')->get(),
            ];
            return response()->json($data);
        }
    }
    public function weekly(Request $request)
    {
        if ($request->weekly_data == "Weekly") {
            $data = [
                'date' => 'From ' . Carbon::today()->subDays(6)->toDateString() . ' To ' . Carbon::today()->toDateString(),
                'weekly' => ProfitSharingView::last7Days('Date')->get(),
            ];
            return response()->json($data);
        }
    }
    public function profit()
    {
        $data = [
            'date' => 'From ' . Carbon::today()->subDays(29)->toDateString() . ' To ' . Carbon::today()->toDateString(),
            'monthly' => ProfitSharingView::last30Days('Date')->get(),
        ];
        return response()->json($data);
    }
    public function yearly(Request $request)
    {
        if ($request->yearly_data == "Yearly") {
            $data = [
                'date' => 'From ' . Carbon::now()->subYear()->toDateString() . ' To ' . Carbon::today()->toDateString(),
                'yearly' => ProfitSharingView::lastYear('Date')->get(),
            ];
            return response()->json($data);
        }
    }
    public function all()
    {
        // $data = ProfitSharingView::all();
        $smallestDate = ProfitSharingView::min('Date');
        $largestDate = ProfitSharingView::max('Date');

        $data = [
            'date' => 'From ' . $smallestDate . ' To ' . $largestDate,
            'allData' => ProfitSharingView::all(),
        ];
        return response()->json($data);
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

    public function history($customer_id)
    {
        $records = PaymentRecord::where('user_id', $customer_id)
            ->with('user')
            ->get();

        $logos = Logo::first();

        if (request()->expectsJson()) {
            if ($records->isEmpty()) {
                return response()->json(['no_records' => 'No records found']);
            }
        }


        $packages = [];
        foreach ($records as $paymentRecord) {
            $packages[] = $paymentRecord->package;
        }

        $totalAmount = 0;
        foreach ($packages as $package) {
            $totalAmount += $package->promotion_price;
        }

        if (request()->expectsJson()) {
            return new MemberHistoryResource($logos, $records, $packages, $totalAmount);
        }

        return view(
            'admin.customers.member_history',
            compact('logos', 'records', 'packages', 'totalAmount')
        );
    }

    public function invoice($customer_id)
    {
        $records = PaymentRecord::where('user_id', $customer_id)
            ->with('user')
            ->latest()
            ->first();
        $logos = Logo::first();


        if (request()->expectsJson()) {
            if (is_null($records)) {
                return response()->json(['no_records' => 'No records found']);
            }
        }
        if (request()->expectsJson()) {
            return new InvoiceResource($records, $logos);
        }

        return view('admin.customers.invoice', compact('logos', 'records'));
    }

    public function viewInvoice($customer_id)
    {
        $records = PaymentRecord::where('user_id', $customer_id)
            ->with('user')
            ->latest()
            ->first();
        $logos = Logo::first();
        return view('admin.customers.viewinvoice', compact('records', 'logos'));
    }

    public function generateInvoice($customer_id)
    {
        $records = PaymentRecord::where('user_id', $customer_id)
            ->with('user')
            ->latest()
            ->first();
        $logos = Logo::first();
        $pdf = Pdf::loadView(
            'admin.customers.viewinvoice',
            compact('records', 'logos')
        );
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download(
            'invoice-' . $customer_id . '-' . $todayDate . '.pdf'
        );
        exit();
    }

    public function mailInvoice($customer_id)
    {
        try {
            $data['records'] = PaymentRecord::where('user_id', $customer_id)
                ->with('user')
                ->first();
            $data['logos'] = Logo::first();
            Mail::to($data['records']->user->email)->send(
                new InvoiceMailable($data)
            );
            return redirect('admin/customers')->with(
                'message',
                'Invoice Mail has been sent to ' .
                    $data['records']->user->email
            );
        } catch (\Exception $e) {
            return redirect('admin/customers')->with(
                'message',
                'Something Went Wrong.!'
            );
        }
    }

    public function showExpiredMembers()
    {
        $payment_expired_members = PaymentExpiredMembers::all();

        if (request()->expectsJson()) {
            return new PaymentExpiredMemberResource($payment_expired_members);
        }
        return view(
            'admin.customers.payment_expired_members',
            compact('payment_expired_members')
        );
    }

    public function addPayments(int $member_id)
    {
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();
        return view(
            'admin.customers.add_payment_form',
            $data,
            compact('member_id')
        );
    }

    public function payFees(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => ['required'],
            'package' => ['required'],
            'payment' => ['required'],
        ]);

        $payment_record = new PaymentRecord();
        $payment_expired_members = new PaymentExpiredMembers();

        $package_info = explode(' ', $validatedData['package']);
        $payment_record->package_id = $package_info[0];
        $payment_record->price = $request->price;
        $payment_record->record_date = date('Y.m.d');
        $payment_record->provider_id = $validatedData['payment'];
        $payment_record->customer_id = $validatedData['member_id'];
        if ($payment_record->save()) {
            $payment_expired_members
                ->where('customer_id', $validatedData['member_id'])
                ->delete();
            return redirect('payment_records')->with(
                'message',
                'Pay Gym Fee Successfully'
            );
        }
    }

    public function print($customer_id)
    {
        $records = ProductPaymentRecords::with('user')->get()
            ->where('user_id', $customer_id)
            ->groupBy('created_at')
            ->last();
        $logos = Logo::first();

        $total = 0;
        foreach ($records as $record) {
            $total += $record->total;
        }
        return view('admin.customers.print', compact('records', 'logos', 'total'));
    }

    public function printPackage($customer_id)
    {
        $records = PaymentRecord::where('user_id', $customer_id)
            ->with('user', 'package')
            ->latest()
            ->first();
        $logos = Logo::first();

        if (!$records) {
            return response()->json(['no_records' => 'No records found']);
        }
        return view('admin.customers.printPackage', ['records' => $records, 'logos' => $logos]);
    }
}
