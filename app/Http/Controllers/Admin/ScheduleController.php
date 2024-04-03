<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\DaysOfWeek;
use App\Models\GymSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ScheduleController extends Controller
{
    public function index(){
        $schedules = GymSchedule::all();
        return view('admin.schedule.index',compact('schedules'));
    }

    public function create(){
        $dayOfWeek = DaysOfWeek::get();
        return view('admin.schedule.create',compact('dayOfWeek'));
    }

    public function store(ScheduleFormRequest $request){
        // dd($request);
        $validatedData = $request->validated();
        // dd($validatedData);
        try {
        $schedule = new GymSchedule();
        $schedule->hours_From = $validatedData['hours_From'];
        $schedule->hours_To = $validatedData['hours_To'];
        $schedule->days_of_week_id = $validatedData['days_of_week_id'];
        $schedule->save();
        return redirect(route('schedule.index'))->with('message','Schedule Created Successfully');
        }catch (Exception $e) {
            return redirect(route('schedule.index'))->with('error', 'An error occurred while updating schedule');
        }
    }

    public function edit($id){
        $schedule= GymSchedule::findOrFail($id);
        $dayOfWeek = DaysOfWeek::get();
        return view('admin.schedule.edit',compact('schedule','dayOfWeek'));
    }

    public function update(ScheduleFormRequest $request,$id){
        $validatedData = $request->validated();
        $schedule = GymSchedule::findOrFail($id);

        $schedule->hours_From = $validatedData['hours_From'];
        $schedule->hours_To = $validatedData['hours_To'];
        $schedule->days_of_week_id = $validatedData['days_of_week_id'];
        $schedule->update();
        return redirect(route('schedule.index'))->with('message','Schedule Updated Successfully');
    }

    public function destroy($id){
        $schedule = GymSchedule::findOrFail($id);
        $schedule->delete();
        return redirect(route('schedule.index'))->with('message','Schedule Deleted Successfully');
    }
}
