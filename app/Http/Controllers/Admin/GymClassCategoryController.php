<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\GymClassCategory;
use App\Traits\UploadImageTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\GymClassCategoryResource;
use App\Http\Requests\GymClassCategoryFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GymClassCategoryController extends Controller
{
    use UploadImageTrait;
    public function index(){ 
     $classCategories = GymClassCategory::paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
    if (request()->expectsJson()) {
        return GymClassCategoryResource::collection($classCategories);
    }
     return view('admin.classcategory.index',compact('classCategories'));
    }

    public function create(){
        return view('admin.classcategory.create');
    }

   public function store(GymClassCategoryFormRequest $request)
{
    try{
        $validatedData = $request->validated(); 

        $classCategory = new GymClassCategory();
        $classCategory->name = $validatedData['name'];
        $classCategory->description = $validatedData['description'];
        $this->uploadImage($request, $classCategory, "classcategory");
     
        $classCategory->save();

        if ($request->expectsJson()) {
            return new GymClassCategoryResource($classCategory);
        }

        return redirect(route('class-category.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.CREATED_GYM_CLASS_CATEGORY'));
    } catch (ModelNotFoundException $e) { 
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.SOMETHING_WENT_WRONG')
            ], Response::HTTP_NOT_FOUND);
        }
}


    public function edit(GymClassCategory $class){
    //  $gymClassCategories =GymClassCategory::get();
     return view('admin.classcategory.edit',compact('class'));
    } 

    public function update(GymClassCategoryFormRequest $request, String $class){ 
       try{
            $validateData =$request->validated();  
            $gymClass =GymClassCategory::findOrFail($class);
            $gymClass->name = $validateData['name'];
            $gymClass->description= $validateData['description'];
            // $gymClass->image= $validateData['image']?? $gymClass['image'];
            $this->uploadImage($request, $gymClass, "classcategory");
            
                $gymClass->update();
                if ($request->expectsJson()) {
                    return new GymClassCategoryResource($gymClass);
                }
                return redirect(route('class-category.index'))->with('message',Config::get('variables.SUCCESS_MESSAGES.UPDATED_GYM_CLASS_CATEGORY'));
          } catch (ModelNotFoundException $e) {
            // GymClassCategory with the provided ID not found
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_GYM_CLASS_CATEGORY')
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($class){
        try {
            $classCategory = GymClassCategory::findOrFail($class);
            $this->deleteImage($classCategory);
            // $path = public_path($classCategory->image);
            // if (File::exists($path)) {
            //     File::delete($path);
            // }
            $classCategory->delete();
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Gymclass Category has been deleted successfully',
                ]);
            }else{
                return redirect(route('class-category.index'))->with('message', Config::get('variables.SUCCESS_MESSAGES.DELETED_GYM_CLASS_CATEGORY'));
            }
            
        } catch (ModelNotFoundException $e) {
            // GymClassCategory with the provided ID not found
            return response()->json([
                'message' => Config::get('variables.ERROR_MESSAGES.NOT_FOUND_GYM_CLASS_CATEGORY')
            ], Response::HTTP_NOT_FOUND);
        }
    }   
}

