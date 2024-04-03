<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Models\Township;
use Illuminate\Http\Request;
use App\Http\Requests\TownshipRequest;
use App\Http\Resources\TownshipResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TownshipController extends Controller
{

    private $township;
    public function __construct()
    {
        $this->township = new Township();
    }

    public function index()
    {
       $townships = Township::all();
        if(request()->expectsJson()){
            return TownshipResource::collection($townships);
        }
       return view('admin.address.township.index',compact('townships'));
      }
      public function create()
      {
          $city = City::get();
          return view('admin.address.township.create',compact('city'));
      }

    public function store(TownshipRequest $request)
    {
        if(request()->expectsJson()){
            $validatedData = $request->validated();
        $this->township->name = $validatedData['name'];
        $this->township->city_id = $validatedData['city_id'];
        $this->township->save();

        if(!$this->township){
            return response()->json([
                'message' => 'Township not found'
            ], 401);
        }
        return new TownshipResource($this->township);
        }
        try {
            $valitadedData = $request->validated();
            $township = new Township();
            $township->name = $valitadedData['name'];
            $township->city_id = $valitadedData['city_id'];
            $township->save();
            return redirect(route('township.index'))->with('message','Township Created Successfully');
           } catch (ModelNotFoundException $e) {
            return redirect(route('township.index'))->with('error', 'township not found');
        }  catch (Exception $e) {
            return redirect(route('township.index'))->with('error', 'An error occurred while updating township');
        }
    }

    public function show($id)
    {
        //
    }


    public function edit(Township $township)
    {
        $cities = City::get();
        return view('admin.address.township.edit',compact('township','cities'));
    }

    public function update(TownshipRequest $request, string $id)
    {
        if(request()->expectsJson()){
            $validatedData = $request->validated();
        $city = Township::find($id);
        if(!$city){
            return response()->json([
                'message' => 'city not found'
            ],401);
        }
        $city->name = $validatedData['name'];
        $city->city_id = $validatedData['city_id'];
        $city->save();
        return new TownshipResource($city);
        }
        try {
            $valitadedData = $request->validated();
            $township =Township::findOrFail($id);

            $township->name = $valitadedData['name'];
            $township->city_id = $valitadedData['city_id'];

            $township->update();
            return redirect(route('township.index'))->with('message','Township Updated Scuccessfully');
           } catch (ModelNotFoundException $e) {
            return redirect(route('township.index'))->with('error', 'township not found');
        }  catch (Exception $e) {
            return redirect(route('township.index'))->with('error', 'An error occurred while updating township');
        }
    }

    public function destroy(Township $township)
    {
        if(request()->expectsJson()){
      return $township->delete()? response(status:204): response(status:500);
        }
        try {
            $township->delete();
            return redirect(route('township.index'))->with('message','Township Deleted Scuccessfully');
        } catch (ModelNotFoundException $e) {
            return redirect(route('township.index'))->with('error', 'township not found');
        }  catch (Exception $e) {
            return redirect(route('township.index'))->with('error', 'An error occurred while updating township');
        }
    }
}
