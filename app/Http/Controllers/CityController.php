<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $city;
    public function __construct()
    {
        $this->city = new City();
    }

    public function index()
    {
       $countries = City::all();
       return CityResource::collection($countries);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
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
    public function update(CityRequest $request, string $id)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
      return $city->delete()? response(status:204): response(status:500);
    }
}
