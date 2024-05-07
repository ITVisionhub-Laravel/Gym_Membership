<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Ward;
use App\Models\Street;
use Illuminate\Http\Request;
use App\Http\Requests\WardRequest;
use App\Http\Requests\StreetRequest;
use App\Http\Resources\StreetResource;
use Illuminate\Support\Facades\Config;
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
       $streets = Street::paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
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

    public function update(StreetRequest $request, string $street)
    {
       if(request()->expectsJson()){
        $validatedData = $request->validated();
        $street = Street::find($street);
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
        $street = Street::findOrFail($street);

        $street->name = $validatedData['name'];
        $street->ward_id = $validatedData['ward_id'];

        $street->update();
        return redirect(route('street.index'))->with('message','Street Updated Successfully');
       }catch (ModelNotFoundException $e) {
        return redirect(route('street.index'))->with('error', 'street not found');
    }  catch (Exception $e) {
        return redirect(route('street.index'))->with('error', 'An error occurred while updating street');
    }
    }

    public function destroy(Street $street)
    {
        try {
            $street->delete();
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Street has been deleted successfully',
                ]);
            }
            return redirect(route('street.index'))->with('message','Street Deleted Successfully');
        }catch (ModelNotFoundException $e) {
            return redirect(route('street.index'))->with('error', 'street not found');
        }  catch (Exception $e) {
            return redirect(route('street.index'))->with('error', 'An error occurred while updating street');
        }

    }
}
