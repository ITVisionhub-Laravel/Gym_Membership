<?php

namespace App\Http\Controllers;

use App\Http\Requests\WardRequest;
use App\Http\Resources\WardResource;
use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ward;
    public function __construct()
    {
        $this->ward = new Ward();
    }

    public function index()
    {
       $ward = Ward::all();
       return WardResource::collection($ward);
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

    public function store(WardRequest $request)
    {
        $validatedData = $request->validated();
        $this->ward->name = $validatedData['name'];
        $this->ward->township_id = $validatedData['township_id'];
        $this->ward->save();

        if(!$this->ward){
            return response()->json([
                'message' => 'Ward not found'
            ], 401);
        }
        return new WardResource($this->ward);
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
    public function update(WardRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $ward = Ward::find($id);
        if(!$ward){
            return response()->json([
                'message' => 'ward not found'
            ],401);
        }
        $ward->name = $validatedData['name'];
        $ward->township_id = $validatedData['township_id'];
        $ward->save();
        return new WardResource($ward);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ward $ward)
    {
      return $ward->delete()? response(status:204): response(status:500);
    }
}
