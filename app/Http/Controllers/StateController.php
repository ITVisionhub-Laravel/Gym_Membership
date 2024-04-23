<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\State;
use App\Models\Country; 
use Illuminate\Http\Response;
use App\Http\Requests\StateRequest;
use App\Http\Resources\StateResource;
use Illuminate\Support\Facades\Config;
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
        try { 
            $validatedData = $request->validated(); 
            // Check if the country ID exists
            $country = Country::find($validatedData['country_id']);
            if (!$country) { 
                return response()->json([
                    'message' => 'Invalid Country ID provided'
                ], Response::HTTP_BAD_REQUEST);
            }
            $this->state->name = $validatedData['name'];
            $this->state->country_id = $validatedData['country_id']; 
            $this->state->save(); 
            if(request()->expectsJson()){  
                return new StateResource($this->state);
            }
            return redirect(route('state.index'))->with('message','State Created Successfully');
           } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_STATE')
            ], Response::HTTP_NOT_FOUND);
            // return redirect(route('state.index'))->with('error', 'State not found');
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
        try {
            $validatedData = $request->validated();
            $state = State::findOrFail($id);

            // Check if the country ID exists
            $country = Country::find($validatedData['country_id']);
            if (!$country) {
                return response()->json([
                    'message' => 'Invalid Country ID provided'
                ], Response::HTTP_BAD_REQUEST);
            }
            $state->name = $validatedData['name'];
            $state->country_id = $validatedData['country_id'];

            $state->update();
            if ($request->expectsJson()) {
                return new StateResource($state);
            }
            return redirect(route('state.index'))->with('message','State Updated Successfully');
           }catch (ModelNotFoundException $e) {
                return response()->json([
                    'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_STATE')
                ], Response::HTTP_NOT_FOUND);
            // return redirect(route('state.index'))->with('error', 'State not found');
        } catch (Exception $e) {
            return redirect(route('state.index'))->with('error', 'An error occurred while updating state');
        }
    }


    public function destroy($state)
    {
        try {
            $state = State::findOrFail($state);
            $this->deleteImage($state);
            $state->delete();
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'State has been deleted successfully',
                ]);
            }
            return redirect(route('state.index'))->with('message', 'State Deleted Successfully');
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_STATE')
            ], Response::HTTP_NOT_FOUND);
            //   return redirect(route('state.index'))->with('error', 'State not found');
        } catch (Exception $e) {
            return redirect(route('state.index'))->with('error', 'An error occurred while updating state');
        } 
    }
}
