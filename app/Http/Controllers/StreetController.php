<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Ward;
use App\Models\Street;
use Illuminate\Http\Request;
use App\Http\Requests\WardRequest;
use App\Http\Requests\StreetRequest;
use App\Http\Resources\StreetResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StreetController extends Controller
{
    private $street;
    public function __construct()
    {
        $this->street = new Street();
    }

    public function index()
    {
       $streets = Street::all();
       if(request()->expectsJson()){
        return StreetResource::collection($streets);
       }
       return view('admin.address.street.index',compact('streets'));
    }

    public function create()
    {
        $ward = Ward::get();
        // dd($ward);
       return view('admin.address.street.create',compact('ward'));
    }

    public function store(StreetRequest $request)
    {
       if(request()->expectsJson()){
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
       try {
        $validatedData = $request->validated();
        $street = new Street();
        $street->name = $validatedData['name'];
        $street->ward_id = $validatedData['ward_id'];
        $street->save();
        return redirect(route('street.index'))->with('message','Street Created Successfully');
    } catch (ModelNotFoundException $e) {
        return redirect(route('street.index'))->with('error', 'street not found');
    }  catch (Exception $e) {
        return redirect(route('street.index'))->with('error', 'An error occurred while updating street');
    }
    }

    public function show($id)
    {
        //
    }

    public function edit(Street $street)
    {
        $wards = Ward::get();
        return view('admin.address.street.edit',compact('street','wards'));
    }

    public function update(StreetRequest $request, string $id)
    {
       if(request()->expectsJson()){
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
       try {
        $validatedData = $request->validated();
        $street = Street::findOrFail($id);

        $street->name = $validatedData['name'];
        $street->ward_id = $validatedData['ward_id'];

        $street->update();
        return redirect(route('street.update'))->with('message','Street Updated Successfully');
       }catch (ModelNotFoundException $e) {
        return redirect(route('street.index'))->with('error', 'street not found');
    }  catch (Exception $e) {
        return redirect(route('street.index'))->with('error', 'An error occurred while updating street');
    }
    }

    public function destroy(Street $street)
    {
        if(request()->expectsJson()){
      return $street->delete()? response(status:204): response(status:500);
        }
        try {
            $street->delete();
            return redirect(route('street.index'))->with('message','Street Deleted Successfully');
        }catch (ModelNotFoundException $e) {
            return redirect(route('street.index'))->with('error', 'street not found');
        }  catch (Exception $e) {
            return redirect(route('street.index'))->with('error', 'An error occurred while updating street');
        }

    }
}
