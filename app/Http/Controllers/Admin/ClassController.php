<?php

namespace App\Http\Controllers\Admin;

use App\Models\GymClass;
use Illuminate\Http\Response;
use App\Traits\UploadImageTrait;
use App\Models\GymClassCategory;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\GymClassResource;
use App\Http\Requests\GymClassFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassController extends Controller
{
    use UploadImageTrait;
    public function index()
    {
        $classes = GymClass::paginate(10);
        if (request()->expectsJson()) {
            return GymClassResource::collection($classes);
        }
        return  view('admin.class.index',compact('classes'));
    }
    public function create()
    {
        $classCategories = GymClassCategory::get();

      return view('admin.class.create',['classCategories'=>$classCategories]);
    }

    public function store(GymClassFormRequest $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validated();

            // Check if the gym class category exists
            $category = GymClassCategory::find($validatedData['gym_class_category_id']);
            if (!$category) {
                // Gym class category does not exist, return an error response
                return response()->json([
                    'message' => 'Invalid gym class category ID provided'
                ], Response::HTTP_BAD_REQUEST);
            }

            // If gym class category exists, proceed to create the gym class
            $class = new GymClass();
            $class->name = $validatedData['name'];
            $class->description = $validatedData['description'];
            $class->gym_class_category_id = $validatedData['gym_class_category_id'];
            $this->uploadImage($request, $class, "class");
            $class->save();

            // If the request expects JSON, return the gym class resource
            if ($request->expectsJson()) {
                return new GymClassResource($class);
            }

            // If not JSON, redirect with success message
            return redirect(route('class.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.CREATED_GYM_CLASS'));
        } catch (ModelNotFoundException $e) {
            // Catch any model not found exceptions
            return response()->json([
                'message' => Config::get('constants.ERROR_MESSAGES.SOMETHING_WENT_WRONG')
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function edit(GymClass $gymClass)
    {
        $classCategory= GymClassCategory::get();
        return view('admin.class.edit',compact('gymClass','classCategory'));
    }

    public function update(GymClassFormRequest $request,$class)
    {
        try{
            $validatedData = $request->validated();
            // Check if the gym class category exists
            $category = GymClassCategory::find($validatedData['gym_class_category_id']);
            if (!$category) {
                // Gym class category does not exist, return an error response
                return response()->json([
                    'message' => 'Invalid gym class category ID provided'
                ], Response::HTTP_BAD_REQUEST);
            }

            $gymClass = GymClass::findOrFail($class);
            $gymClass->name = $validatedData['name'];
            $gymClass->description = $validatedData['description'];
            $gymClass->gym_class_category_id = $validatedData['gym_class_category_id'];
            $this->uploadImage($request, $gymClass, "gymClass");

            $gymClass->update();
            if ($request->expectsJson()) {
                return new GymClassResource($gymClass);
            }
            return redirect(route('class.index'))->with('message',Config::get('variables.SUCCESS_MESSAGES.UPDATED_GYM_CLASS'));
        } catch (ModelNotFoundException $e) {
            // GymClassCategory with the provided ID not found
            return response()->json([
                'message' =>Config::get('constants.ERROR_MESSAGES.NOT_FOUND_GYM_CLASS')
            ], Response::HTTP_NOT_FOUND);
        }
    }
    public function destroy($class)
    {
        try {
            $gymClass = GymClass::findOrFail($class);
            $path=public_path($gymClass->image);
            if(File::exists($path)){
                File::delete($path);
            }
            $gymClass->delete();
            if (request()->expectsJson()) {
                return new GymClassResource($gymClass);
            }
            return redirect(route('class.index'))->with('message',Config::get('variables.SUCCESS_MESSAGES.DELETED_GYM_CLASS'));
        } catch (ModelNotFoundException $e) {
            // GymClassCategory with the provided ID not found
            return response()->json([
                'message' =>Config::get('constants.ERROR_MESSAGES.NOT_FOUND_GYM_CLASS')
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
