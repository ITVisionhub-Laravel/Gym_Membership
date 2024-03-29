<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $country;
    public function __construct()
    {
        $this->country = new Country();
    }

    public function index()
    {
       $countries = Country::all();
       return CountryResource::collection($countries);
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
    public function store(CountryRequest $request)
    {
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

    public function update(CountryRequest $request, string $id)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        dd($country);
      return $country->delete()? response(status:204): response(status:500);
    }
}
