<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendentResource;
use App\Models\Attendent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendentController extends Controller
{
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
        if (request()->expectsJson()) {
            return AttendentResource::collection($attendents);
        }
        return view('admin.attendent.index', compact('attendents'));
    }

    public function create( )
    { 
        
    }

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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        $attendent= Attendent::find($id);
        $attendent->delete();
        if (request()->expectsJson()) {
           return new AttendentResource($attendent);
        }
        return redirect()->route('attendents.index');
    }
}
