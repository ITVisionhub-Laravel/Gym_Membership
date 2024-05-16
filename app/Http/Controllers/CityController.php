<?php

namespace App\Http\Controllers;
  
use App\Models\City;
use App\Models\State; 
use App\Exceptions\ErrorException; 
use App\Http\Requests\CityRequest;
use App\Contracts\LocationInterface;
use App\Http\Resources\CityResource; 
use Illuminate\Support\Facades\Config; 

class CityController extends Controller
{ 
    private $locationInterface;

    public function __construct(LocationInterface $locationInterface)
    {
        $this->locationInterface = $locationInterface;
    }

    public function index()
    {
        $cities = $this->locationInterface->all('City');
        if (request()->is('api/*')) {
            return CityResource::collection($cities);
        }
        return view('admin.address.city.index', compact('cities'));
       
    }

    public function create()
    {
        $states = State::get();
        return view('admin.address.city.create',compact('states'));
    }


    public function store(CityRequest $request)
    {
        $validatedData = $request->validated(); 
        // Check if the State ID exists
        $state = $this->locationInterface->findById('State', $validatedData['state_id']);
        if (!$state) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_STATE_ID'));
        }
       
        $city = $this->locationInterface->store('City', $validatedData);
        if (request()->is('api/*')) {
            return new CityResource($city);
        }
        return redirect(route('city.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.CREATED_CITY'));
        
    }

    public function show($id)
    {
        //
    }

    public function edit(City $city)
    {
        $state = State::get();
        return view('admin.address.city.edit',compact('city','state'));
    }


    public function update(CityRequest $request, string $city)
    {
        $validatedData = $request->validated();

        // Check if the state ID exists
        $state = $this->locationInterface->findById('State', $validatedData['state_id']);
        if (!$state) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_STATE_ID'));
        }
        $city = $this->locationInterface->update('City', $validatedData, $city);
        if ($request->is('api/*')) {
            return new CityResource($city);
        }
        return redirect(route('city.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.UPDATED_CITY'));
        
    }

    public function destroy($city)
    {
        $this->locationInterface->delete('City', $city); 
        if (request()->is('api/*')) {
            return response()->json([
                'status' => Config::get('variables.SUCCESS_MESSAGES.RESPONSE_STATUS_CODE'),
                'message' => Config::get('variables.SUCCESS_MESSAGES.DELETED_CITY'),
            ]);
        }
        return redirect(route('city.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.DELETED_CITY'));
    }
}
