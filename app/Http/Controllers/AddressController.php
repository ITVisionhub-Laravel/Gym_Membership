<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $address;
    public function __construct()
    {
        $this->address = new Address();
    }

    public function index()
    {
       $address = Address::all();
       return AddressResource::collection($address);
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
    public function store(AddressRequest $request)
    {
        dd(auth()->user()->id);
        $validatedData = $request->validated();
        $this->address->user_id = Auth::user()->id;
        $this->address->street_id = $validatedData['street_id'];
        $this->address->block_no = $validatedData['block_no'];
        $this->address->floor = $validatedData['floor'];
        $this->address->zipcode = $validatedData['zipcode'];
        $this->address->save();

        if(!$this->address){
            return response()->json([
                'message' => 'address not found'
            ], 401);
        }
        return new AddressResource($this->address);
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
    public function update(AddressRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $address = Address::find($id);
        if(!$address){
            return response()->json([
                'message' => 'address not found'
            ],401);
        }
        $address->user_id = Auth::auth()->id;
        $address->street_id = $validatedData['street_id'];
        $address->block_no = $validatedData['block_no'];
        $address->floor = $validatedData['floor'];
        $address->zipcode = $validatedData['zipcode'];
        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
      return $address->delete()? response(status:204): response(status:500);
    }
}
