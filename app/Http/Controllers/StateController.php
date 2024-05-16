<?php

namespace App\Http\Controllers;
 
use App\Models\State;
use App\Models\Country; 
use App\Exceptions\ErrorException;
use App\Http\Requests\StateRequest;
use App\Contracts\LocationInterface;
use App\Http\Resources\StateResource;
use Illuminate\Support\Facades\Config; 

class StateController extends Controller
{
    private $locationInterface;

    public function __construct(LocationInterface $locationInterface)
    {
        $this->locationInterface = $locationInterface;
    }

    public function index()
    { 
        $states = $this->locationInterface->all('State');
        if (request()->is('api/*')) {
            return StateResource::collection($states);
        }
        return view('admin.address.state.index',compact('states'));

    }

    public function create()
    {
      $countries =Country::get();
      return view('admin.address.state.create',['countries'=>$countries]);

    }
    public function store(StateRequest $request)
    {
        $validatedData = $request->validated();
        // Check if the Country ID exists
        $country = $this->locationInterface->findById('Country', $validatedData['country_id']);
        if (!$country) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_COUNTRY_ID'));
        }
        $state = $this->locationInterface->store('State', $validatedData);
        if (request()->is('api/*')) {
            return new StateResource($state);
        }
        return redirect(route('state.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.CREATED_STATE'));

    }

    public function show($id)
    {
        //
    }

    public function edit(State $state)
    {
        $countries =Country::get();
        return view('admin.address.state.edit',compact('state','countries'));
    }

    public function update(StateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        // Check if the Country ID exists
        $country = $this->locationInterface->findById('Country', $validatedData['country_id']);
        if (!$country) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_COUNTRY_ID'));
        }
        $state = $this->locationInterface->update('State', $validatedData, $id);
        if ($request->is('api/*')) {
            return new StateResource($state);
        }
        return redirect(route('state.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.UPDATED_STATE'));
    }


    public function destroy($state)
    {
        $this->locationInterface->delete('State', $state);
        if (request()->is('api/*')) {
            return response()->json([
                'status' => Config::get('variables.SUCCESS_MESSAGES.RESPONSE_STATUS_CODE'),
                'message' => Config::get('variables.SUCCESS_MESSAGES.DELETED_STATE'),
            ]);
        }
        return redirect(route('state.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.DELETED_STATE'));
    }
}
