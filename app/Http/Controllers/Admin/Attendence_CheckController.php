<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Attendent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

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

        $member_id = Customer::where(
            'member_card',
            $validatedData['member_check']
        )->value('id');

        $todayDate = Carbon::now()->format('Y-m-d');

        //       if ($member_id->isEmpty()) {
        //     // Member does not exist, return JSON response indicating that
        //     return new JsonResponse(['memberExists' => false]);
        // }
        if (!$member_id) {
            $data = ['wrongMemberId' => true];
            return response()->json($data);
        }
        $attendent_check = Attendent::where('customer_id', $member_id)
            ->where('attendent_date', $todayDate)
            ->first();

        if (!$attendent_check) {
            // Member is new, create the 'Attendent' record
            $newAttendent = new Attendent();
            $newAttendent->attendent_date = $todayDate;
            $newAttendent->customer_id = $member_id; // Assigning the correct value

            // Save the new 'Attendent' record
            $newAttendent->save();

            // Member is new, return JSON response indicating success
            $data = ['success' => true];
            return response()->json($data);
        }
        $data = ['memberExists' => true];
        return response()->json($data);
        // return new JsonResponse(['memberExists' => true]);
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'member_check' => ['required'],
    //     ]);

    //     $attendent_check = Customer::where(
    //         'member_card',
    //         $request->member_check
    //     )->first();

    //     if (!$attendent_check) {
    //         return redirect()
    //             ->route('attendents.index')
    //             ->with('error', 'Customer not found');
    //     }

    //     $member_card_id = $attendent_check->id;
    //     $todayDate = Carbon::now()->format('Y-m-d');

    //     $attendent = Attendent::where('customer_id', $member_card_id)->first();

    //     if ($attendent) {
    //         return redirect()
    //             ->route('attendents.index')
    //             ->with('error', 'Attendent record already exists');
    //     }

    //     $newAttendent = new Attendent();
    //     $newAttendent->attendent_date = $todayDate;
    //     $newAttendent->customer_id = $member_card_id;
    //     $newAttendent->save();

    //     return redirect()
    //         ->route('attendents.index')
    //         ->with('success', 'Attendent created successfully');
    // }

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
