<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentPackage;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\PaymentPackageResource;

class PaymentPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentpackages = PaymentPackage::paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
        if (request()->expectsJson()) {
            return PaymentPackageResource::collection($paymentpackages);
        }
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
        $validatedData = $request->validate([
            'package' => ['required'],
            'promotion' => ['required'],
            'original_price' => ['required'],
        ]);
        $paymentpackage = new PaymentPackage();
        $paymentpackage->package = $request->package;
        $paymentpackage->promotion = $request->promotion;
        $paymentpackage->original_price = $request->original_price;
        $promotion_price =
            (int) $paymentpackage->original_price -
            ((int) $paymentpackage->original_price *
                (int) $paymentpackage->promotion) /
            100;
        $paymentpackage->promotion_price = $promotion_price;
        $paymentpackage->save();
        if (request()->expectsJson()) {
            return new PaymentPackageResource($paymentpackage);
        }
        return redirect()->route('payment_packages.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $paymentpackage = PaymentPackage::find($id);
        return view('admin.paymentpackage.edit', compact('paymentpackage'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->all();

        $paymentpackage = PaymentPackage::find($id);

        $paymentpackage->package = $request->package;
        $paymentpackage->promotion = $request->promotion;
        $paymentpackage->original_price = $request->original_price;
        $promotion_price =
            (int) $paymentpackage->original_price -
            ((int) $paymentpackage->original_price *
                (int) $paymentpackage->promotion) /
            100;
        $paymentpackage->promotion_price = $promotion_price;
        $paymentpackage->update($validatedData);

        if (request()->expectsJson()) {
            return new PaymentPackageResource($paymentpackage);
        }
        return redirect()->route('payment_packages.index');
    }


    public function destroy($id)
    {
        $paymentpackage = PaymentPackage::find($id);
        $success = $paymentpackage->delete();
        if (request()->expectsJson()) {
            return response()->json([
                'status' => 200,
                'message' => 'Package has been deleted successfully',
            ]);
        }
        return redirect()->route('payment_packages.index');
    }
}
