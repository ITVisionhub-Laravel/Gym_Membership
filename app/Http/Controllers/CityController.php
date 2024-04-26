<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Response;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CityController extends Controller
{

    private $city;
    public function __construct()
    {
        $this->city = new City();
    }

    public function index()
    {
       $cities = City::paginate(10);
       if(request()->expectsJson()){
        return CityResource::collection($cities);
       }
       return view('admin.address.city.index',compact('cities'));
    }

    public function create()
    {
        $states = State::get();
        return view('admin.address.city.create',compact('states'));
    }


    public function store(CityRequest $request)
    {
        try {
            $validatedData = $request->validated();
            // Check if the State ID exists
            $state = State::find($validatedData['state_id']);
            if (!$state) {
                return response()->json([
                    'message' => 'Invalid State ID provided'
                ], Response::HTTP_BAD_REQUEST);
            }
            $this->city->name = $validatedData['name'];
            $this->city->country_id = $validatedData['state_id'];
            $this->city->save();
            if (request()->expectsJson()) {
                return new CityResource($this->city);
            }
            return redirect(route('city.index'))->with('message', 'City Created Successfully');
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_CITY')
            ], Response::HTTP_NOT_FOUND);
            // return redirect(route('city.index'))->with('error', 'City not found');
        } catch (Exception $e) {
            return redirect(route('city.index'))->with('error', 'An error occurred while updating city');
        }

    }

    public function show($id)
    {
        //
    }

    public function edit(City $city)
    {
        $state = State::get();
        return view('admin.address.city.edit',compact('city','state'));
    }


    public function update(CityRequest $request, string $id)
    {
        try {
            $validatedData = $request->validated();

            // Check if the state ID exists
            $state = State::find($validatedData['state_id']);
            if (!$state) {
                return response()->json([
                    'message' => 'Invalid State ID provided'
                ], Response::HTTP_BAD_REQUEST);
            }

            $city = City::findOrFail($id);
            $city->name = $validatedData['name'];
            $city->state_id = $validatedData['state_id'];

            $city->update();
            if ($request->expectsJson()) {
                return new CityResource($city);
            }
            return redirect(route('city.index'))->with('message', 'City Updated Successfully');
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_CITY')
            ], Response::HTTP_NOT_FOUND);
            // return redirect(route('city.index'))->with('error', 'City not found');
        } catch (Exception $e) {
            return redirect(route('city.index'))->with('error', 'An error occurred while updating city');
        }
    }

    public function destroy($city)
    {
        try {
            $city = State::findOrFail($city);
            // $this->deleteImage($city);
            $city->delete();
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'City has been deleted successfully',
                ]);
            }
            return redirect(route('city.index'))->with('message', 'City Deleted Successfully');
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_CITY')
            ], Response::HTTP_NOT_FOUND);
            // return redirect(route('city.index'))->with('error', 'City not found');
        } catch (Exception $e) {
            return redirect(route('city.index'))->with('error', 'An error occurred while updating city');
        }
    }
}
