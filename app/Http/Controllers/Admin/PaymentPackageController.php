<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentPackage;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PaymentPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentpackages = PaymentPackage::all();
        return view('admin.paymentpackage.index', compact('paymentpackages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentpackage.create');
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
            'package' => ['required'],
            'promotion' => ['required'],
            'original_price' => ['required'],
        ]);
        $paymentpackage = new PaymentPackage();
        $paymentpackage->package=$request->package;
        $paymentpackage->promotion=$request->promotion;
        $paymentpackage->original_price=$request->original_price;
        $paymentpackage->save();

        return redirect()->route('payment_packages.index');
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
        $paymentpackage = PaymentPackage::find($id);
        return view('admin.paymentpackage.edit', compact('paymentpackage'));
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
        $paymentpackage = PaymentPackage::find($id);
        $paymentpackage->package=$request->package;
        $paymentpackage->promotion=$request->promotion;
        $paymentpackage->original_price=$request->original_price;
        $paymentpackage->save();

        return redirect()->route('payment_packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentpackage = PaymentPackage::find($id);
        $paymentpackage->delete();
        return redirect()->route('payment_packages.index');

    }
}
