<?php

namespace App\Http\Controllers;
 
use App\Models\Country; 
use App\Contracts\LocationInterface;
use App\Http\Requests\CountryRequest;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\CountryResource; 

class CountryController extends Controller
{
    private $locationInterface;

    public function __construct(LocationInterface $locationInterface)
    {
        $this->locationInterface = $locationInterface;
    }

    public function index()
    {
       $countries = $this->locationInterface->all('Country');
       if(request()->is('api/*')){
        return CountryResource::collection($countries);
       }
       return view('admin.address.country.index',compact('countries'));

    }

    public function create()
    {
        return view('admin.address.country.create');

    }

    public function store(CountryRequest $request)
    {
        $validatedData = $request->validated();
        $country = $this->locationInterface->store('Country', $validatedData);
        if (request()->is('api/*')) {
            return new CountryResource($country);
        }
        return redirect(route('country.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.CREATED_COUNTRY'));
        
    }

    public function show($id)
    {
        //
    }

    public function edit(Country $country)
    {
        return view('admin.address.country.edit',compact('country'));
    }

    public function update(CountryRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $country = $this->locationInterface->update('Country', $validatedData, $id);
        if ($request->is('api/*')) {
            return new CountryResource($country);
        }
        return redirect(route('country.index'))->with('message',Config::get('variables.SUCCESS_MESSAGES.UPDATED_COUNTRY'));
      
    }

    public function destroy($country)
    {
        $this->locationInterface->delete('Country', $country);
        if (request()->is('api/*')) {
            return response()->json([
                'status' => Config::get('variables.SUCCESS_MESSAGES.RESPONSE_STATUS_CODE'),
                'message' => Config::get('variables.SUCCESS_MESSAGES.DELETED_COUNTRY'),
            ]);
        }
        return redirect(route('country.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.DELETED_COUNTRY'));
       
    }
}
