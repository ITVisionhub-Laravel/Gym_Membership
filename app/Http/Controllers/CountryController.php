<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryController extends Controller
{
    private $country;
    public function __construct()
    {
        $this->country = new Country();
    }

    public function index()
    {
       $countries = Country::all();
       if(request()->expectsJson()){
        return CountryResource::collection($countries);
       }
       return view('admin.address.country.index',compact('countries'));

    }

    public function create()
    {
        return view('admin.address.country.create');

    }

    public function store(CountryRequest $request)
    {
        if(request()->expectsJson()){
            $validatedData = $request->validated();
            $this->country->name = $validatedData['name'];
            $this->country->save();

            if(!$this->country){
                return response()->json([
                    'message' => 'Country not found'
                ], 401);
            }
            return new CountryResource($this->country);
        }

        try {
            $validatedData = $request->validated();
            $country =new Country();
            $country->name = $validatedData['name'];

            $country->save();
            return redirect(route('country.index'))->with('message','Country Created Successfully');
          } catch (ModelNotFoundException $e) {
            return redirect(route('country.index'))->with('error', 'Country not found');
        } catch (Exception $e) {
            return redirect(route('country.index'))->with('error', 'An error occurred while updating country');
        }

    }

    public function show($id)
    {
        //
    }

    public function edit(Country $country)
    {
        return view('admin.address.country.edit',compact('country'));
    }

    public function update(CountryRequest $request, string $id)
    {
       if(request()->expectsJson()){
        $validatedData = $request->validated();
        $country = Country::find($id);
        if(!$country){
            return response()->json([
                'message' => 'Country not found'
            ],401);
        }
        $country->name = $validatedData['name'];
        $country->save();
        return new CountryResource($country);
       }
       try {
        $validatedData = $request->validated();
        $country = Country::find($id);
        $country->name = $validatedData['name'];
        $country->update();
        return redirect(route('country.index'))->with('message','Country Updated Successfully');
       }  catch (ModelNotFoundException $e) {
        return redirect(route('country.index'))->with('error', 'Country not found');
    } catch (Exception $e) {
        return redirect(route('country.index'))->with('error', 'An error occurred while updating country');
    }
    }

    public function destroy(Country $country)
    {
        if(request()->expectsJson()){
            return $country->delete()? response(status:204): response(status:500);
        }
        try {
            $country = Country::findOrFail($country);
            $country->delete();
            return redirect(route('country.index'))->with('message','Country Deleted Successfully');
           }  catch (ModelNotFoundException $e) {
            return redirect(route('country.index'))->with('error', 'Country not found');
        } catch (Exception $e) {
            return redirect(route('country.index'))->with('error', 'An error occurred while updating country');
        }
    }
}
