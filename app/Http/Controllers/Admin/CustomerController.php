<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerFormRequest;
use App\Models\City;
use App\Models\Customer;
use App\Models\PaymentPackage;
use App\Models\Street;
use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function index()
    {
        $customers=Customer::all();
        return view('admin.customers.index',compact('customers'));
    }
    public function create()
    {
        // dd('hit');
         $data['cities'] = City::get(["name", "id"]);
         $data['packages'] = PaymentPackage::get(["package", "promotion"]);
        // $packages=PaymentPackage::all();
        return view('admin.customers.create',$data);
    }
    public function fetchTownship(Request $request)
    {
        $data['townships'] = Township::where("city_id",$request->city_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchStreet(Request $request)
    {
        $data['streets'] = Street::where("township_id",$request->township_id)->get(["name", "id"]);
        return response()->json($data);
    }
    
    public function store(CustomerFormRequest $request)
    {
        $validatedData = $request->validated();
        $customer = new Customer();
        $customer->name = $validatedData['name'];
        $customer->age=$validatedData['age'];
        $customer->height=$validatedData['height'];
        $customer->weight=$validatedData['weight'];
        $customer->phone_number=$validatedData['phone_number'];
        $customer->emergency_phone=$validatedData['emergency_phone'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/customer/', $filename);
            $customer->image = $filename;
        }
        $customer->save();
        // dd($customer->save());
        return redirect('admin/customers')->with(
            'message',
            'Customer Added Successfully'
        );
    }
    public function edit(Customer $customer)
    {
        // dd("hello");
        return view('admin.customers.edit',compact('customer'));
    }
    public function update(CustomerFormRequest $request,$customer)
    {
        // dd($customer);
        $validatedData=$request->validated();
        $customer=Customer::findOrFail($customer);
        $customer->name=$validatedData['name'];
        $customer->age=$validatedData['age'];
        $customer->height=$validatedData['height'];
        $customer->weight=$validatedData['weight'];
        $customer->phone_number=$validatedData['phone_number'];
        $customer->emergency_phone=$validatedData['emergency_phone'];
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
        $customer->update();
        return redirect('admin/customers')->with('message','Customer Updated Successfully');
    }

    public function destroy($customer_id)
    {
        $customer=Customer::findOrFail($customer_id);
        $path = public_path('uploads/customer/' . $customer->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        $customer->delete();
        return redirect('admin/customers')->with('message','Customer Deleted Successfully');
    }
    public function payment()
    {
        $data['customers'] = Customer::get(["name", "id"]);
        return view('admin.customers.payment',$data);
    }
    public function invoice()
    {
        return view('admin.customers.invoice'); 
    }
}
