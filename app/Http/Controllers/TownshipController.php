<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TownshipRequest;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\TownshipResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TownshipController extends Controller
{

    private $township;
    public function __construct()
    {
        $this->township = new Township();
    }

    public function index()
    {
       $townships = Township::paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
        if(request()->expectsJson()){
            return TownshipResource::collection($townships);
        }
       return view('admin.address.township.index',compact('townships'));
      }
      public function create()
      {
          $city = City::get();
          return view('admin.address.township.create',compact('city'));
      }

    public function store(TownshipRequest $request)
    {
        try {
            $validatedData = $request->validated();
            // Check if the City ID exists
            $city = City::find($validatedData['city_id']);
            if (!$city) {
                return response()->json([
                    'message' => 'Invalid City ID provided'
                ], Response::HTTP_BAD_REQUEST);
            }
            $this->township->name = $validatedData['name'];
            $this->township->city_id = $validatedData['city_id'];
            $this->township->save();
            if (request()->expectsJson()) {
                return new TownshipResource($this->township);
            }
            return redirect(route('township.index'))->with('message', 'Township Created Successfully');
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_TOWNSHIP')
            ], Response::HTTP_NOT_FOUND);
            //  return redirect(route('township.index'))->with('message','Township Created Successfully');
        } catch (Exception $e) {
            return redirect(route('township.index'))->with('error', 'An error occurred while updating township');
        }

    }

    public function show($id)
    {
        //
    }


    public function edit(Township $township)
    {
        $cities = City::get();
        return view('admin.address.township.edit',compact('township','cities'));
    }

    public function update(TownshipRequest $request, string $township)
    {
        try {
            $validatedData = $request->validated();

            // Check if the city ID exists
            $city = City::find($validatedData['city_id']);
            if (!$city) {
                return response()->json([
                    'message' => 'Invalid City ID provided'
                ], Response::HTTP_BAD_REQUEST);
            }

            $township = Township::findOrFail($township);
            $township->name = $validatedData['name'];
            $township->city_id = $validatedData['city_id'];

            $township->update();
            if ($request->expectsJson()) {
                return new TownshipResource($township);
            }
            return redirect(route('township.index'))->with('message', 'Township Updated Successfully');
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_TOWNSHIP')
            ], Response::HTTP_NOT_FOUND);
            // return redirect(route('township.index'))->with('message','Township Updated Scuccessfully');
        } catch (Exception $e) {
            return redirect(route('township.index'))->with('error', 'An error occurred while updating township');
        }
    }

    public function destroy($township)
    {
        try {
            $township = Township::findOrFail($township);
            // $this->deleteImage($township);
            $township->delete();
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Township has been deleted successfully',
                ]);
            }
            return redirect(route('township.index'))->with('message', 'Township Deleted Scuccessfully');
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_TOWNSHIP')
            ], Response::HTTP_NOT_FOUND);
            // return redirect(route('township.index'))->with('error', 'township not found');
        } catch (Exception $e) {
            return redirect(route('township.index'))->with('error', 'An error occurred while updating township');
        }
    }
}
