<?php

namespace App\Http\Controllers;

use App\Http\Requests\TownshipRequest;
use App\Http\Resources\TownshipResource;
use App\Models\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $township;
    public function __construct()
    {
        $this->township = new Township();
    }

    public function index()
    {
       $township = Township::all();
       return TownshipResource::collection($township);
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
    public function store(TownshipRequest $request)
    {
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
    public function update(TownshipRequest $request, string $id)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Township $township)
    {
      return $township->delete()? response(status:204): response(status:500);
    }
}
