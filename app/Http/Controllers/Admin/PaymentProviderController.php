<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentProviderResource;
use App\Models\PaymentProvider;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    public function index()
    {
        $paymentproviders = PaymentProvider::all();

        if (request()->expectsJson()) {
            return PaymentProviderResource::collection($paymentproviders);
        }
        
        return view('admin.paymentprovider.index', compact('paymentproviders'));
    }

    public function create()
    {
        return view('admin.paymentprovider.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            
        ]);
        $paymentprovider= new PaymentProvider();
        $paymentprovider->name=$request->name;
        $paymentprovider->save();
        if (request()->expectsJson()) {
            return new PaymentProviderResource($paymentprovider);
        }
        return redirect()->route('payment_providers.index');
        
}

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $paymentprovider = PaymentProvider::find($id);
        return view('admin.paymentprovider.edit', compact('paymentprovider'));

    }

    public function update(Request $request, $id)
    {
        $paymentprovider = PaymentProvider::find($id);
        $paymentprovider->name=$request->name;
        $paymentprovider->save();
        if (request()->expectsJson()) {
            return new PaymentProviderResource($paymentprovider);
        }
        return redirect()->route('payment_providers.index');

    }

    public function destroy($id)
    {
        $paymentprovider = PaymentProvider::find($id);
        $paymentprovider->delete();

        if (request()->expectsJson()) {
            return new PaymentProviderResource($paymentprovider);
        }
        return redirect()->route('payment_providers.index');

        
    }
}
