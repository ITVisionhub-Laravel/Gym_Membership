<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\DaysOfWeek;
use App\Models\GymSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\ScheduleResource;
use App\Http\Requests\ScheduleFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ScheduleController extends Controller
{
    public function index(){
        $schedules = GymSchedule::all();
        if(request()->expectsJson()){
            return  ScheduleResource::collection($schedules);
        }
        return view('admin.schedule.index',compact('schedules'));
    }

    public function create(){
        $dayOfWeek = DaysOfWeek::get();
        return view('admin.schedule.create',compact('dayOfWeek'));
    }

    public function store(ScheduleFormRequest $request){

        try {
        $validatedData = $request->validated();
        $schedule = new GymSchedule();
        $schedule->hours_From = $validatedData['hours_From'];
        $schedule->hours_To = $validatedData['hours_To'];
        $schedule->days_of_week_id = $validatedData['days_of_week_id'];
        $schedule->save();
        if(request()->expectsJson()){
            return new ScheduleResource($schedule);
        }
        return redirect(route('schedule.index'))->with('message',Config::get('variables.SUCCESS_MESSAGES.CREATED_SCHEDULE'));
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'message'=> Config::get('constants.ERROR_MESSAGES.SOMETHING_WENT_WRONG')
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function edit($id){
        $schedule= GymSchedule::findOrFail($id);
        $dayOfWeek = DaysOfWeek::get();
        return view('admin.schedule.edit',compact('schedule','dayOfWeek'));
    }

    public function update(ScheduleFormRequest $request,$id){
        try {
            $validatedData = $request->validated();
            $schedule = GymSchedule::findOrFail($id);

            $schedule->hours_From = $validatedData['hours_From'];
            $schedule->hours_To = $validatedData['hours_To'];
            $schedule->days_of_week_id = $validatedData['days_of_week_id'];
            $schedule->update();
            if(request()->expectsJson()){
                return new ScheduleResource($schedule);
            }
            return redirect(route('schedule.index'))->with('message',Config::get('variables.SUCCESS_MESSAGES.UPDATED_SCHEDULE'));

        }  catch (ModelNotFoundException $e) {
            // GymClassCategory with the provided ID not found
            return response()->json([
                'message' =>Config::get('constants.ERROR_MESSAGES.NOT_FOUND_GYM_CLASS')
            ], Response::HTTP_NOT_FOUND);
        }

    }

    public function destroy($id){
       try {
        $schedule = GymSchedule::findOrFail($id);
        $schedule->delete();
        if(request()->expectsJson()){
            return new ScheduleResource($schedule);
        }
        return redirect(route('schedule.index'))->with('message',Config::get('variables.SUCCESS_MESSAGES.DELETED_SCHEDULE'));
       } catch (ModelNotFoundException $e) {
        // GymClassCategory with the provided ID not found
        return response()->json([
            'message' =>Config::get('constants.ERROR_MESSAGES.NOT_FOUND_GYM_CLASS')
        ], Response::HTTP_NOT_FOUND);
    }
    }
}
