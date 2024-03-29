<?php

namespace App\Http\Controllers;

use App\Http\Requests\StreetRequest;
use App\Http\Requests\WardRequest;
use App\Http\Resources\StreetResource;
use App\Models\Street;
use Illuminate\Http\Request;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $street;
    public function __construct()
    {
        $this->street = new Street();
    }

    public function index()
    {
       $street = Street::all();
       return StreetResource::collection($street);
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
    public function store(StreetRequest $request)
    {
        $validatedData = $request->validated();
        $this->street->name = $validatedData['name'];
        $this->street->ward_id = $validatedData['ward_id'];
        $this->street->save();

        if(!$this->street){
            return response()->json([
                'message' => 'street not found'
            ], 401);
        }
        return new streetResource($this->street);
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
    public function update(StreetRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $street = Street::find($id);
        if(!$street){
            return response()->json([
                'message' => 'street not found'
            ],401);
        }
        $street->name = $validatedData['name'];
        $street->ward_id = $validatedData['ward_id'];
        $street->save();
        return new StreetResource($street);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Street $street)
    {
      return $street->delete()? response(status:204): response(status:500);
    }
}
