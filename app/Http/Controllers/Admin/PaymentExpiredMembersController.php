<?php

namespace App\Http\Controllers;

use App\Models\PaymentExpiredMembers;
use App\Http\Requests\StorePaymentExpiredMembersRequest;
use App\Http\Requests\UpdatePaymentExpiredMembersRequest;

class PaymentExpiredMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentExpiredMembersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentExpiredMembersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentExpiredMembers  $paymentExpiredMembers
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentExpiredMembers $paymentExpiredMembers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentExpiredMembers  $paymentExpiredMembers
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentExpiredMembers $paymentExpiredMembers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentExpiredMembersRequest  $request
     * @param  \App\Models\PaymentExpiredMembers  $paymentExpiredMembers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentExpiredMembersRequest $request, PaymentExpiredMembers $paymentExpiredMembers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentExpiredMembers  $paymentExpiredMembers
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentExpiredMembers $paymentExpiredMembers)
    {
        //
    }
}
