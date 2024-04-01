<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Logo;
use App\Models\Street;
use App\Models\Address;
use App\Models\Customer;
use App\Models\GymClass;
use App\Models\Township;
use Illuminate\Http\Request;
use App\Mail\InvoiceMailable;
use App\Models\PaymentRecord;
use App\Models\CustomerQRCode;
use App\Models\PaymentPackage;
use Illuminate\Support\Carbon;
use App\Models\PaymentProvider;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Models\PaymentExpiredMembers;
use App\Http\Requests\CustomerFormRequest;
use App\Http\Requests\MemberInfoValidation;
use App\Models\ProductPaymentRecords;
use App\Models\ProfitSharingView;
use App\Models\State;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::with('address')
        ->where('role_as', 0)
        ->get();

        return view('admin.customers.index', compact('customers'));
    }
    public function create()
    {
        $data['cities'] = City::get(['name', 'id']);
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();
        $data['gymclasses'] = GymClass::get();
        return view('admin.customers.create', $data);
    }
    public function fetchState(Request $request)
    {
        $data['states'] = State::where(
            'country_id',
            $request->country_id
        )->get(['name', 'id']);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where(
            'state_id',
            $request->state_id
        )->get(['name', 'id']);
        return response()->json($data);
    }
    public function fetchTownship(Request $request)
    {
        $data['townships'] = Township::where(
            'city_id',
            $request->city_id
        )->get(['name', 'id']);
        return response()->json($data);
    }
    public function fetchWard(Request $request)
    {
        $data['wards'] = Ward::where(
            'township_id',
            $request->township_id
        )->get(['name', 'id']);
        return response()->json($data);
    }
    public function fetchStreet(Request $request)
    {
        $data['streets'] = Street::where(
            'ward_id',
            $request->ward_id
        )->get(['name', 'id']);
        return response()->json($data);
    }
    public function daily(Request $request)
    {
        if($request->daily_data == "Daily")
        {
            $today = Carbon::today();
            $data['daily'] = ProfitSharingView::where('Date', $today)->get();
            return response()->json($data);
        }
    }
    public function store(CustomerFormRequest $request)
    {
        $validatedData = $request->validated();
        $customer = new User();
        $address = new Address();

        $customer->name = Auth::user()->name;
        $customer->email = Auth::user()->email;
        $customer->age = $validatedData['age'];
        $customer->member_card = time();
        $customer->password = bcrypt('00000');
        $customer->height = $validatedData['height'];
        $customer->weight = $validatedData['weight'];
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
            return $customer;
            return redirect('admin/customers')->with(
                'message',
                'Customer Added Successfully'
            );
        }
        // @dd($customer);
        // if ($customer->save()) {
        //     if ($request->hasFile('bank_slip')) {
        //         $file = $request->file('bank_slip');
        //         $ext = $file->getClientOriginalExtension();
        //         $filename = time() . '.' . $ext;
        //         $file->move('uploads/bankslip/', $filename);
        //         $payment_record->bank_slip = $filename;
        //     }
        //     $package_info = explode(' ', $request->package);
        // $payment_record->package_id = $package_info[0];
        // $payment_record->price = $request->price;
        // $payment_record->record_date = date('Y.m.d');
        // $payment_record->provider_id = $request->payment;
        // $payment_record->customer_id = $customer->id;
        // // @dd($payment_record);
        //     if (!$payment_record->save()) {
        //         $customer->delete();
        //     } else {
        // if ($payment_record->save()) {
        //     $customerQRCode = new CustomerQRCode();
        //     $customerQRCode->member_card_id = $customer->member_card;
        //     $customerQRCode->user_id = 0;
        //     // @dd($customerQRCode);
        //     if ($customerQRCode->save()) {
        //         return redirect('admin/customers')->with(
        //             'message',
        //             'Customer Added Successfully'
        //         );
        //     } else {
        //         $customer->delete();
        //         $payment_record->delete();
        //     }
        //         }
        //     }
        // }
    }
    public function edit(User $customer)
    {
        // dd("hello");
        $data['cities'] = City::get(['name', 'id']);
        $data['townships'] = Township::get();
        $data['streets'] = Street::get();
        $data['gymclasses'] = GymClass::get();
        $data['payment_records'] = PaymentRecord::where(
            'user_id',
            $customer->id
        )->get();
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();
        return view('admin.customers.edit', $data, compact('customer'));
    }
    public function update(Request $request, $customer)
    {
        // dd($request);
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
            'gymclass' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
        ]);
        // dd($validatedData);
        $customer = User::findOrFail($customer);
        $address = new Address();

        $customer->name = $validatedData['name'];
        $customer->age = $validatedData['age'];
        $customer->email = $validatedData['email'];
        $customer->height = $validatedData['height'];
        $customer->weight = $validatedData['weight'];

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

        $customer->class_id = $validatedData['gymclass'];
        // @dd($customer);
        if ($request->hasFile('image')) {
            $path = public_path('uploads/customer/' . $customer->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/customer/', $filename);
            $customer->image = $filename;
        }
        if ($customer->update()) {
            // $payment_record = new PaymentRecord();
            // $package_info = explode(' ', $request->package);
            // PaymentRecord::where('customer_id', $customer->id)->update([
            //     'package_id' => $package_info[0],
            //     'price' => $request->price,
            //     'record_date' => date('Y.m.d'),
            //     'provider_id' => $request->payment,
            //     'customer_id' => $customer->id,
            // ]);
            return redirect('admin/customers')->with(
                'message',
                'Customer Updated Successfully'
            );
        }
    }
    public function destroy($customer_id)
    {
        // return $customer_id;

        $customer = User::findOrFail($customer_id);
        $path = public_path('uploads/customer/' . $customer->image);

        if (File::exists($path)) {
            File::delete($path);
        }
        if ($customer->delete()) {
            PaymentRecord::where('user_id', $customer_id)->delete();
            PaymentExpiredMembers::where('user_id', $customer_id)->delete();
        }

        return redirect('admin/customers')->with(
            'message',
            'Customer Deleted Successfully'
        );
    }

    public function history($customer_id)
    {
        $records = PaymentRecord::where('user_id', $customer_id)
            ->with('user')
            ->get();

        $logos = Logo::first();

        if ($records->isEmpty()) {
            return response()->json(['no_records' => 'No records found']);
        }

        $packages = [];
        foreach ($records as $paymentRecord) {
            $packages[] = $paymentRecord->package;
        }

        $totalAmount = 0;
        foreach ($packages as $package) {
            $totalAmount += $package->promotion_price;
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

        if (!$records) {
            return response()->json(['no_records' => 'No records found']);
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
        // $expiredMembers = [];
        // foreach (json_decode($expiredPaymentMembers) as $expiredMember) {
        //     array_push(
        //         $expiredMembers,
        //         Customer::where('id', $expiredMember)->first()
        //     );
        // }

        $payment_expired_members = PaymentExpiredMembers::all();

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
        return view('admin.customers.print', compact('records', 'logos','total'));
    }

    public function printPackage($customer_id)
    {
        $records = PaymentRecord::where('user_id', $customer_id)
            ->with('user','package')
            ->latest()
            ->first();
        $logos = Logo::first();

        if (!$records) {
            return response()->json(['no_records' => 'No records found']);
        }
        return view('admin.customers.printPackage', ['records' => $records, 'logos' => $logos]);
    }
}
