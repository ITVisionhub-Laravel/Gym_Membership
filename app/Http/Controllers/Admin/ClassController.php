<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trainer;
use App\Models\GymClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ClassController extends Controller
{
    public function index()
    {
        $classes = GymClass::all();
        return view('admin.class.index',compact('classes'));
    }
    public function create()
    {
        $data['trainers'] = Trainer::get();
        return view('admin.class.create',$data);
    }
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name'=>['string'],
            'description'=>['string'],
            'morning_time'=>['string'],
            'evening_time'=>['string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png']
        ]);
        $trainer=new Trainer();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/class/', $filename);
            $validatedData['image'] = "uploads/class/$filename";
        }
        GymClass::create([
            'name'=>$validatedData['name'],
            'image' => $validatedData['image'],
            'description' => $validatedData['description'],
            'morning_time' => $validatedData['morning_time'],
            'evening_time' => $validatedData['evening_time'],
            'trainer_id'=>$request->trainer_id,
        ]);
        return redirect('admin/class')->with(
            'message',
            'Class Added Successfully'
        );
    }
    public function edit(GymClass $class)
    {
        $data['trainers'] = Trainer::get();
        return view('admin.class.edit', compact('class'),$data);
    }

    public function update(Request $request, GymClass $class)
    {
        $validatedData = $request->validate([
            'name'=>['string'],
            'description'=>['string'],
            'morning_time'=>['string'],
            'evening_time'=>['string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png']
        ]);
        if ($request->hasFile('image')) {
            $destination = public_path($class->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/class/', $filename);
            $validatedData['image'] = "uploads/class/$filename";
        }
        // dd($validatedData['image']);
    Gymclass::where('id', $class->id)->update([
            'name'=>$validatedData['name'],
            'image' => $validatedData['image'] ?? $class->image,
            'description' => $validatedData['description'],
            'morning_time' => $validatedData['morning_time'],
            'evening_time' => $validatedData['evening_time'],
            'trainer_id'=>$request->trainer_id,
        ]);
        return redirect('admin/class')->with(
            'message',
            'Class Updated Successfully'
        );
    }
    public function destroy($class_id)
        {
            $class = GymClass::findOrFail($class_id);
            $path = public_path('uploads/trainer/' . $class->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $class->delete();
            return redirect('admin/class')->with(
                'message',
                'Class Deleted Successfully'
            );
            
        }
}
