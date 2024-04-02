<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\GymClassCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Resources\GymClassCategoryResource;
use App\Http\Requests\GymClassCategoryFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GymClassCategoryController extends Controller
{
    public function index(){ 
     $classCategories = GymClassCategory::paginate(10);
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
    $validatedData = $request->validated(); 

    $classCategory = new GymClassCategory();
    $classCategory->name = $validatedData['name'];
    $classCategory->description = $validatedData['description'];

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('uploads/classcategory/', $filename);
        $classCategory->image = $filename;
    }

    $classCategory->save();

    if ($request->expectsJson()) {
        return new GymClassCategoryResource($classCategory);
    }

    return redirect(route('class-category.index'))->with('message', 'Class Category Added Successfully');
}


    public function edit(GymClassCategory $class){
    //  $gymClassCategories =GymClassCategory::get();
     return view('admin.classcategory.edit',compact('class'));
    }

    // public function update(GymClassCategoryFormRequest $request, String $class){
    //     dd("hello");
    // }

    public function update(GymClassCategoryFormRequest $request, String $class){
        
        $validateData =$request->validated(); 
        $gymClass =GymClassCategory::findOrFail($class);

        $gymClass->name = $validateData['name'];
        $gymClass->description= $validateData['description'];
        $gymClass->gym_class_id= $validateData['gym_class_category_id'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/classcategory/', $filename);
            $gymClass->image = "$filename";
        }
            $gymClass->update();
            if ($request->expectsJson()) {
                return new GymClassCategoryResource($gymClass);
            }
            return redirect(route('class-category.index'))->with('message','Gym Class Category Updated Successfully'
          );
    }

    public function destroy($class){
        try {
            $classCategory = GymClassCategory::findOrFail($class);
            $path = public_path($classCategory->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $classCategory->delete();
            if (request()->expectsJson()) {
                return new GymClassCategoryResource($classCategory);
            }
            return redirect(route('class-category.index'))->with('message', 'Class Category Deleted Successfully');
        } catch (ModelNotFoundException $e) {
            // GymClassCategory with the provided ID not found
            return response()->json([
                'message' => 'Gym Class Category not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }   
}

