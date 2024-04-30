<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Ward;
use App\Models\Township;
use Illuminate\Http\Request;
use App\Http\Requests\WardRequest;
use App\Http\Resources\WardResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WardController extends Controller
{

    private $ward;
    public function __construct()
    {
        $this->ward = new Ward();
    }

    public function index()
    {
       $wards = Ward::paginate(10);
       if(request()->expectsJson()){
        return WardResource::collection($wards);
       }
       return view('admin.address.ward.index',compact('wards'));
    }

    public function create()
    {
        $township = Township::get();
        return view('admin.address.ward.create',compact('township'));
    }

    public function store(WardRequest $request)
    {
       if(request()->expectsJson()){
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
       try {
        $validatedData = $request->validated();
        $ward = new Ward();
        $ward->name = $validatedData['name'];
        $ward->township_id = $validatedData['township_id'];
        $ward->save();
        return redirect(route('ward.index'))->with('message','Ward Created Successfully');
    } catch (ModelNotFoundException $e) {
        return redirect(route('ward.index'))->with('error', 'ward not found');
    }  catch (Exception $e) {
        return redirect(route('ward.index'))->with('error', 'An error occurred while updating ward');
    }
    }

    public function show($id)
    {
        //
    }

    public function edit(Ward $ward)
    {
        $townships = Township::get();
        return view('admin.address.ward.edit',compact('ward','townships'));

    }

    public function update(WardRequest $request, string $ward)
    {
       if(request()->expectsJson()){
        $validatedData = $request->validated();
        $ward = Ward::find($ward);
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
       try {
        $validatedData =$request->validated();
        $ward=Ward::findOrFail($ward);

        $ward->name = $validatedData['name'];
        $ward->township_id = $validatedData['township_id'];
        $ward->update();
        return redirect(route('ward.index'))->with('message','Ward Updated Successfully');
       } catch (ModelNotFoundException $e) {
        return redirect(route('ward.index'))->with('error', 'ward not found');
    }  catch (Exception $e) {
        return redirect(route('ward.index'))->with('error', 'An error occurred while updating ward');
    }
    }

    public function destroy(Ward $ward)
    {
        try {
            $ward->delete();
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Ward has been deleted successfully',
                ]);
            }
        return redirect(route('ward.index'))->with('message','Ward Deleted Successfully');
        } catch (ModelNotFoundException $e) {
            return redirect(route('ward.index'))->with('error', 'ward not found');
        }  catch (Exception $e) {
            return redirect(route('ward.index'))->with('error', 'An error occurred while updating ward');
        }
    }
}
