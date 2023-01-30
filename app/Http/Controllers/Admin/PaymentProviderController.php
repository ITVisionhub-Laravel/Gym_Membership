<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentProvider;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentproviders = PaymentProvider::all();
        return view('admin.paymentprovider.index', compact('paymentproviders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentprovider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => ['required'],
            
        ]);
        $paymentprovider= new PaymentProvider();
        $paymentprovider->name=$request->name;
        $paymentprovider->save();

        return redirect()->route('payment_providers.index');
        
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
        $paymentprovider = PaymentProvider::find($id);
        return view('admin.paymentprovider.edit', compact('paymentprovider'));

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
        $paymentprovider = PaymentProvider::find($id);
        $paymentprovider->name=$request->name;
        $paymentprovider->save();

        return redirect()->route('payment_providers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentprovider = PaymentProvider::find($id);
        $paymentprovider->delete();
        return redirect()->route('payment_providers.index');

        
    }
}
