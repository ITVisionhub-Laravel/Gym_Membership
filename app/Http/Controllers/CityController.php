<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
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
       $cities = City::all();
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
       if(request()->expectsJson()){
        $validatedData = $request->validated();
        $this->city->name = $validatedData['name'];
        $this->city->state_id = $validatedData['state_id'];
        $this->city->save();

        if(!$this->city){
            return response()->json([
                'message' => 'City not found'
            ], 401);
        }
        return new CityResource($this->city);
       }
       try {
        $validatedData = $request->validated();
        $city =new City();
        $city->name = $validatedData['name'];
        $city->state_id = $validatedData['state_id'];
        $city->save();
        return redirect(route('city.index'))->with('message','City Created Successfully');
    }catch (ModelNotFoundException $e) {
        return redirect(route('city.index'))->with('error', 'City not found');
    }  catch (Exception $e) {
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
        if(request()->expectsJson()){
            $validatedData = $request->validated();
        $city = City::find($id);
        if(!$city){
            return response()->json([
                'message' => 'city not found'
            ],401);
        }
        $city->name = $validatedData['name'];
        $city->state_id = $validatedData['state_id'];
        $city->save();
        return new CityResource($city);
        }
        try {
            $validatedData = $request->validated();
            $city = City::findOrFail($id);

            $city->name = $validatedData['name'];
            $city->state_id = $validatedData['state_id'];

            $city->update();

            return redirect(route('city.index'))->with('message', 'City Updated Successfully');
        } catch (ModelNotFoundException $e) {
            return redirect(route('city.index'))->with('error', 'City not found');
        } catch (Exception $e) {
            return redirect(route('city.index'))->with('error', 'An error occurred while updating city');
        }
    }

    public function destroy(City $city)
    {
        if(request()->expectsJson()){
            return $city->delete()? response(status:204): response(status:500);
        }
        try {
            $city->delete();
            return redirect(route('city.index'))->with('message','City Deleted Successfully');
           } catch (ModelNotFoundException $e) {
            return redirect(route('city.index'))->with('error', 'City not found');
        } catch (Exception $e) {
            return redirect(route('city.index'))->with('error', 'An error occurred while updating city');
        }
    }
}
