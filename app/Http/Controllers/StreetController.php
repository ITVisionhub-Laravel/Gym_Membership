<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Ward;
use App\Models\Street;
use Illuminate\Http\Request;
use App\Exceptions\ErrorException;
use App\Http\Requests\WardRequest;
use App\Contracts\LocationInterface;
use App\Http\Requests\StreetRequest;
use App\Http\Resources\StreetResource;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StreetController extends Controller
{
    private $locationInterface;

    public function __construct(LocationInterface $locationInterface)
    {
        $this->locationInterface = $locationInterface;
    }

    public function index()
    {
        $streets = $this->locationInterface->all('Street');
        if (request()->is('api/*')) {
            return StreetResource::collection($streets);
        }
        return view('admin.address.street.index',compact('streets'));
    }

    public function create()
    {
        $ward = Ward::get(); 
       return view('admin.address.street.create',compact('ward'));
    }

    public function store(StreetRequest $request)
    {
        $validatedData = $request->validated();
        // Check if the Ward ID exists
        $ward = $this->locationInterface->findById('Ward', $validatedData['ward_id']);
        if (!$ward) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_WARD_ID'));
        }

        $street = $this->locationInterface->store('Street', $validatedData);
        if (request()->is('api/*')) {
            return new streetResource($street);
        }
        return redirect(route('street.index'))->with('message', Config::get('variables.ERROR_MESSAGES.CREATED_STREET'));
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
        $validatedData = $request->validated();
        // Check if the Ward ID exists
        $ward = $this->locationInterface->findById('Ward', $validatedData['ward_id']);
        if (!$ward) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_WARD_ID'));
        }

        $street = $this->locationInterface->update('Street', $validatedData, $street);
        if (request()->is('api/*')) {
            return new StreetResource($street);
        }
        return redirect(route('street.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.UPDATED_STREET'));
    }

    public function destroy($street)
    {
        $this->locationInterface->delete('Street', $street);
        if (request()->is('api/*')) {
            return response()->json([
                'status' => Config::get('variables.SUCCESS_MESSAGES.RESPONSE_STATUS_CODE'),
                'message' => Config::get('variables.SUCCESS_MESSAGES.DELETED_STREET'),
            ]);
        }
        return redirect(route('street.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.DELETED_STREET'));
    }
}
