<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\StateRequest;
use App\Http\Resources\StateResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StateController extends Controller
{

    private $state;
    public function __construct()
    {
        $this->state = new State();
    }

    public function index()
    {
       $states = State::all();
       if(request()->expectsJson()){
        return StateResource::collection($states);
       }
      return view('admin.address.state.index',compact('states'));

    }

    public function create()
    {
      $countries =Country::get();
      return view('admin.address.state.create',['countries'=>$countries]);

    }
    public function store(StateRequest $request)
    {
        if(request()->expectsJson()){
            $validatedData = $request->validated();
            $this->state->name = $validatedData['name'];
            $this->state->country_id = $validatedData['country_id'];
            $this->state->save();

            if(!$this->state){
                return response()->json([
                    'message' => 'Country not found'
                ], 401);
            }
            return new StateResource($this->state);
        }
        try {
            $validateDate = $request->validated();
            $state = new State();
            $state->name = $validateDate['name'];
            $state->country_id = $validateDate['country_id'];
            $state->save();
            return redirect(route('state.index'))->with('message','State Created Successfully');
           } catch (ModelNotFoundException $e) {
            return redirect(route('state.index'))->with('error', 'State not found');
        } catch (Exception $e) {
            return redirect(route('state.index'))->with('error', 'An error occurred while updating state');
        }

    }

    public function show($id)
    {
        //
    }

    public function edit(State $state)
    {
        $countries =Country::get();
        return view('admin.address.state.edit',compact('state','countries'));
    }

    public function update(StateRequest $request, string $id)
    {
        if(request()->expectsJson()){
            $validatedData = $request->validated();
        $states = State::find($id);
        if(!$states){
            return response()->json([
                'message' => 'states not found'
            ],401);
        }
        $states->name = $validatedData['name'];
        $states->country_id = $validatedData['country_id'];
        $states->save();
        return new StateResource($states);
        }

        try {
            $valitadedData = $request->validated();
            $state = State::findOrFail($id);

            $state->name = $valitadedData['name'];
            $state->country_id = $valitadedData['country_id'];

            $state->update();
            return redirect(route('state.index'))->with('message','State Updated Successfully');
           }catch (ModelNotFoundException $e) {
            return redirect(route('state.index'))->with('error', 'State not found');
        } catch (Exception $e) {
            return redirect(route('state.index'))->with('error', 'An error occurred while updating state');
        }
    }


    public function destroy(State $state)
    {
        if(request()->expectsJson()){
        return $state->delete()? response(status:204): response(status:500);
        }
        try {
            $state->delete();
              return redirect(route('state.index'))->with('message','State Deleted Successfully');
             } catch (ModelNotFoundException $e) {
              return redirect(route('state.index'))->with('error', 'State not found');
          } catch (Exception $e) {
              return redirect(route('state.index'))->with('error', 'An error occurred while updating state');
          }
    }
}
