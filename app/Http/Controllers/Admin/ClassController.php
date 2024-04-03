<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GymClassFormRequest;
use App\Models\GymClassCategory;
use App\Models\Trainer;
use App\Models\GymClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassResource;
use Illuminate\Support\Facades\File;

class ClassController extends Controller
{
    public function index()
    {
        $classes = GymClass::paginate(3);
        // $classCategories = GymClassCategory::get();

        return  view('admin.class.index',compact('classes'));

        // return view('admin.class.index',[
        //     'classes'=>$classes,
        //     'classCategories'=>$classCategories
        // ]);

    }
    public function create()
    {
        $classCategories = GymClassCategory::get();

      return view('admin.class.create',['classCategories'=>$classCategories]);
    }

    public function store(GymClassFormRequest $request)
    {
        $validatedData =$request->validated();
        $class = new GymClass();
        $class->name = $validatedData['name'];
        $class->description = $validatedData['description'];
        $class->gym_class_category_id =$validatedData['gym_class_category_id'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/class/', $filename);
            $class->image = "$filename";
        }
        $class->save();
        return redirect(route('class.index'))->with('message','Gym Class Created Successfully');
    }

    public function edit(GymClass $gymClass)
    {
        $classCategory= GymClassCategory::get();
       return view('admin.class.edit',compact('gymClass','classCategory'));
    }

    public function update(GymClassFormRequest $request,$class)
    {
        $validatedData = $request->validated();
        $gymClass = GymClass::findOrFail($class);

        $gymClass->name = $validatedData['name'];
        $gymClass->description = $validatedData['description'];
        $gymClass->gym_class_category_id =$validatedData['gym_class_category_id'];


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/class/', $filename);
            $gymClass->image = "$filename";
        }
        $gymClass->update();
        return redirect(route('class.index'))->with('message','Gym Class Updated Successfully');


    }
    public function destroy($class)
    {
        $gymClass = GymClass::findOrFail($class);
        $path=public_path($gymClass->image);
        if(File::exists($path)){
            File::delete($path);
        }
        $gymClass->delete();
        return redirect(route('class.index'))->with('message','Gym Class Deleted Successfully');
    }
}
