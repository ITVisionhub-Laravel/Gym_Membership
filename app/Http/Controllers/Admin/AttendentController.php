<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $todayDate = Carbon::now()->format('Y-m-d');
        // $attendents = Attendent::whereDate('attendent_date' ,$todayDate)->get();
        $attendents=Attendent::when($request->date !=null,function($q) use ($request){
                return $q->whereDate('created_at',$request->date);
            },function($q) use ($todayDate){
                return $q->whereDate('created_at',$todayDate);
            })
            ->paginate(10);
        return view('admin.attendent.index', compact('attendents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( )
    { 
        
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
            'member' => ['required'],            
        
        ]);
         
        $todayDate = Carbon::now()->format('Y-m-d');
        $attendent = new Attendent ();
        $attendent->customer_id=$request->member;
        $attendent->attendent_date=$todayDate;
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
        $attendent= Attendent::find($id);
        $attendent->delete();
        return redirect()->route('attendents.index');
    }
}
