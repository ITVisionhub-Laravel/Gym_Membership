<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Street;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Township;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\Models\PaymentPackage;
use Illuminate\Support\Carbon;
use App\Models\PaymentProvider;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CustomerFormRequest;
use App\Mail\InvoiceMailable;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }
    public function create()
    {
        // dd('hit');
        $data['cities'] = City::get(['name', 'id']);
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();
        // dd($data['packages']);
        // $packages=PaymentPackage::all();
        return view('admin.customers.create', $data);
    }
    public function fetchTownship(Request $request)
    {
        $data['townships'] = Township::where(
            'city_id',
            $request->city_id
        )->get(['name', 'id']);
        return response()->json($data);
    }
    public function fetchStreet(Request $request)
    {
        $data['streets'] = Street::where(
            'township_id',
            $request->township_id
        )->get(['name', 'id']);
        return response()->json($data);
    }

    public function store(CustomerFormRequest $request)
    {
        // return $request;
        $validatedData = $request->validated();
        $customer = new Customer();
        $address = new Address();
        $payment_record = new PaymentRecord();
        $customer->name = $validatedData['name'];
        $customer->age = $validatedData['age'];
        $customer->member_card = $request->member_card;
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/customer/', $filename);
            $customer->image = $filename;
        }
        if ($customer->save()) {
            $package_info = explode(' ', $request->package);
            $payment_record->package_id = $package_info[0];
            $payment_record->price = $request->price;
            $payment_record->record_date = date('Y.m.d');
            $payment_record->provider_id = $request->provider;
            $payment_record->customer_id = $customer->id;
            if (!$payment_record->save()) {
                $customer->delete();
            }
            $payment_record->save();
        }
        return redirect('admin/customers')->with(
            'message',
            'Customer Added Successfully'
        );
    }
    public function edit(Customer $customer)
    {
        // dd("hello");
        $data['cities'] = City::get(['name', 'id']);
        $data['townships'] = Township::get();
        $data['streets'] = Street::get();
        $data['payment_records'] = PaymentRecord::where(
            'customer_id',
            $customer->id
        )->get();
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();
        return view('admin.customers.edit', $data, compact('customer'));
    }
    public function update(CustomerFormRequest $request, $customer)
    {
        // dd($customer);
        $validatedData = $request->validated();
        $customer = Customer::findOrFail($customer);
        $address = new Address();

        $customer->name = $validatedData['name'];
        $customer->age = $validatedData['age'];
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
            $payment_record = new PaymentRecord();
            $package_info = explode(' ', $request->package);
            PaymentRecord::where('customer_id', $customer->id)->update([

            'package_id' => $package_info[0],
            'price' => $request->price,
            'record_date' => date('Y.m.d'),
            'provider_id' => $request->provider,
            'customer_id' => $customer->id,
        ]);

        }
        return redirect('admin/customers')->with(
            'message',
            'Customer Updated Successfully'
        );
    }
    public function destroy($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        $records = PaymentRecord::findOrFail($customer->id);
        $path = public_path('uploads/customer/' . $customer->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        if ($customer->delete()) {
            $records->delete();
        }
        return redirect('admin/customers')->with(
            'message',
            'Customer Deleted Successfully'
        );
    }
    public function payment()
    {
        $data['customers'] = Customer::get(['name', 'id']);
        return view('admin.customers.payment', $data);
    }
    public function invoice($customer_id)
    {
        $customers = Customer::where('id', $customer_id)->get();
        $data['records'] = PaymentRecord::where(
            'customer_id',
            $customer_id
        )->get();
        $data['packages'] = $data['records'][0]->package;
        return view('admin.customers.invoice', $data, compact('customers'));
    }
    public function viewInvoice($customer_id)
    {
       $data['records'] = PaymentRecord::where(
            'customer_id',
            $customer_id
        )->with('customer')->get();
        $data['packages'] = $data['records'][0]->package;
        return view('admin.customers.viewinvoice',compact('data'));
    }
    public function generateInvoice($customer_id)
    {
        $data['records'] = PaymentRecord::where(
                'customer_id',
                $customer_id
                )->with('customer')->get();
        $data['packages'] = $data['records'][0]->package;
        $data=[
            'records'=>$data['records'],
            'packages'=>$data['packages']
        ];
        $pdf = Pdf::loadView('admin.customers.viewinvoice', compact('data'));
        // dd($data);
        $todayDate=Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$customer_id.'-'.$todayDate.'.pdf');
    }
    public function mailInvoice($customer_id)
    {
        try{
            $data['customers'] = Customer::where(
                'id',
                $customer_id
            )->get();
            $data['records'] = PaymentRecord::where(
                'customer_id',
                $customer_id
            )->get();
            $data['packages'] = $data['records'][0]->package;
            // dd($data['customers']);
            Mail::to("eek752000@gmail.com")->send(new InvoiceMailable($data));
            return redirect('admin/customers')->with('message','Invoice Mail has been sent to'."eek752000@gmail.com");
        }catch(\Exception $e){
            return redirect('admin/customers')->with('message','Something Went Wrong.!');
        }
    }
}
