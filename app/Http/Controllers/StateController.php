<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateRequest;
use App\Http\Resources\StateResource;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $state;
    public function __construct()
    {
        $this->state = new State();
    }

    public function index()
    {
       $states = State::all();
       return StateResource::collection($states);
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
    public function store(StateRequest $request)
    {
        $validatedData = $request->validated();
        $this->state->name = $validatedData['name'];
        $this->state->country_id = $validatedData['country_id'];
        $this->state->save();

        if(!$this->state){
            return response()->json([
                'message' => 'Country not found'
            ], 401);
        }
        return new StateResource($this->state);
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
    public function update(StateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $states = State::find($id);
        if(!$states){
            return response()->json([
                'message' => 'states not found'
            ],401);
        }
        $states->name = $validatedData['name'];
        $states->country_id = $validatedData['country_id'];
        $states->save();
        return new StateResource($states);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        return $state->delete()? response(status:204): response(status:500);
    }
}
