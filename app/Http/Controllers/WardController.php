<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use App\Models\Township; 
use App\Exceptions\ErrorException;
use App\Http\Requests\WardRequest;
use App\Contracts\LocationInterface;
use App\Http\Resources\WardResource;
use Illuminate\Support\Facades\Config;

class WardController extends Controller
{

    private $locationInterface;

    public function __construct(LocationInterface $locationInterface)
    {
        $this->locationInterface = $locationInterface;
    }

    public function index()
    {
        $wards = $this->locationInterface->all('Ward');
        if (request()->is('api/*')) {
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
        $validatedData = $request->validated();
        // Check if the Township ID exists
        $township = $this->locationInterface->findById('Township', $validatedData['township_id']);
        if (!$township) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_TOWNSHIP_ID'));
        }

        $ward = $this->locationInterface->store('Ward', $validatedData);
        if (request()->is('api/*')) {
            return new WardResource($ward);
        }
        return redirect(route('ward.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.CREATED_WARD'));
       
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
        $validatedData = $request->validated();
        // Check if the Township ID exists
        $township = $this->locationInterface->findById('Township', $validatedData['township_id']);
        if (!$township) {
            throw ErrorException::errorMessageCode(Config::get('variables.ERROR_MESSAGES.INVALID_TOWNSHIP_ID'));
        }

        $ward = $this->locationInterface->update('Ward', $validatedData, $ward);
        if (request()->is('api/*')) {
            return new WardResource($ward);
        }
        return redirect(route('ward.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.UPDATED_WARD'));
       
    }

    public function destroy($ward)
    {
        $this->locationInterface->delete('Ward', $ward);
        if (request()->is('api/*')) {
            return response()->json([
                'status' => Config::get('variables.SUCCESS_MESSAGES.RESPONSE_STATUS_CODE'),
                'message' => Config::get('variables.SUCCESS_MESSAGES.DELETED_WARD'),
            ]);
        }
        return redirect(route('ward.index'))->with('message',Config::get('variables.SUCCESS_MESSAGES.DELETED_WARD'));
    }
}
