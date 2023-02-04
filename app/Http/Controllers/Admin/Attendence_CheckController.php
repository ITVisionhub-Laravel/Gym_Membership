<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Attendent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class Attendence_CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_check' => ['required'], 

        
        ]);

        $attendent_check = Customer::where('member_card', $request->member_check)->first();
        $member_card_id = $attendent_check->id;
        // dd($member_card_id);
        $todayDate = Carbon::now()->format('Y-m-d');
        $attendent = new Attendent ();
        $attendent->attendent_date=$todayDate;
        $attendent->customer_id=$member_card_id;
        $attendent->save();
        return redirect()->route('attendents.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
