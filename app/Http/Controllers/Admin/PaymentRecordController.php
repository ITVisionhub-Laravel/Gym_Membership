<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\Models\PaymentPackage;
use App\Http\Controllers\Controller;
use App\Models\PaymentProvider;

class PaymentRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentrecords = PaymentRecord::all();
        return view('admin.paymentrecord.index', compact('paymentrecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $members = Customer::all();
        $packages = PaymentPackage::all();
        $payments = PaymentProvider::all();
        return view('admin.paymentrecord.create',compact('members','packages', 'payments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_name' => ['required'],
            'package' => ['required'],
            'price'=>['required'],
            'record_date'=>['required'],
            'payment_record'=>['required'],
            
        ]);
        $paymentrecord = new PaymentRecord();
        $paymentrecord->package_id=$request->package;
        $paymentrecord->price=$request->price;
        $paymentrecord->record_date=$request->record_date;
        $paymentrecord->provider_id=$request->payment_record;
        $paymentrecord->customer_id=$request->member_name;
        // dd($paymentrecord);
        $paymentrecord->save();

        return redirect()->route('payment_records.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentrecord = PaymentRecord::find($id);
        $members = Customer::all();
        $packages = PaymentPackage::all();
        $payments = PaymentProvider::all();
        return view('admin.paymentrecord.edit', compact('paymentrecord','members','packages','payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paymentrecord = PaymentRecord::find($id);
        $paymentrecord->package_id=$request->package;
        $paymentrecord->price=$request->price;
        $paymentrecord->record_date=$request->record_date;
        $paymentrecord->provider_id=$request->payment_record;
        $paymentrecord->customer_id=$request->member_name;
        $paymentrecord->save();

        return redirect()->route('payment_records.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentrecord= PaymentRecord::find($id);
        $paymentrecord->delete();
        return redirect()->route('payment_records.index');
    }
}
