<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\Models\CustomerQRCode;
use App\Models\DebitAndCredit;
use App\Models\PaymentPackage;
use App\Models\PaymentProvider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        $packages = PaymentPackage::all();
        $payments = PaymentProvider::all();
        return view('admin.paymentrecord.edit', compact('paymentrecord','packages','payments'));
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
        $paymentrecord->package_id=$request->package[0];
        $paymentrecord->price=$request->price;
        $paymentrecord->bank_slip=$request->image;
        $paymentrecord->record_date=$request->date;
        $paymentrecord->provider_id=$request->payment_type;
        $paymentrecord->user_id=$paymentrecord->user_id;
        DB::beginTransaction();
        try{            
            if ($paymentrecord->save()) {  
                $debitCredit = DebitAndCredit::where('related_info_id', $paymentrecord->user->member_card)->first();
                $debitCredit->update([
                    'amount' => $request->price,
                    'date' => $request->date,
                    'status' => 'success'
                ]);
                $this->storeCustomerQR();
                return redirect()->route('payment_records.index');
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            dd("Exception occurred: " . $e->getMessage());
        }
        
    }


    public function storeCustomerQR()
    {
        $customerQRCode = new CustomerQRCode();
        $customerQRCode->member_card_id = auth()->user()->member_card;
        $customerQRCode->user_id = auth()->user()->id;

        if ($customerQRCode->save()) {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Pay GymFee Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Fail GymFee Payment',
                'type' => 'error',
                'status' => 404,
            ]);
        }
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
