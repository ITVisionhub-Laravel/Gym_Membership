<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Township; 
use App\Exceptions\ErrorException;
use App\Contracts\LocationInterface;
use App\Http\Requests\TownshipRequest;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\TownshipResource;

class TownshipController extends Controller
{

    private $locationInterface;

    public function __construct(LocationInterface $locationInterface)
    {
        $this->locationInterface = $locationInterface;
    }

    public function index()
    {
        $townships = $this->locationInterface->all('Township');
        if (request()->is('api/*')) {
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
        $validatedData = $request->validated();
        // Check if the City ID exists
        $city = $this->locationInterface->findById('City', $validatedData['city_id']);
        if (!$city) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_CITY_ID'));
        }

        $township = $this->locationInterface->store('Township', $validatedData);
        if (request()->is('api/*')) {
            return new TownshipResource($township);
        }
        return redirect(route('township.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.CREATED_TOWNSHIP'));

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
        $validatedData = $request->validated();
        // Check if the City ID exists
        $city = $this->locationInterface->findById('City', $validatedData['city_id']);
        if (!$city) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_CITY_ID'));
        }

        $township = $this->locationInterface->update('Township', $validatedData, $township);
        if (request()->is('api/*')) {
            return new TownshipResource($township);
        }
        return redirect(route('township.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.UPDATED_TOWNSHIP'));
       
    }

    public function destroy($township)
    {
        $this->locationInterface->delete('Township', $township);
        if (request()->is('api/*')) {
            return response()->json([
                'status' => Config::get('variables.SUCCESS_MESSAGES.RESPONSE_STATUS_CODE'),
                'message' => Config::get('variables.SUCCESS_MESSAGES.DELETED_TOWNSHIP'),
            ]);
        }
        return redirect(route('township.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.DELETED_TOWNSHIP'));
    }
}
