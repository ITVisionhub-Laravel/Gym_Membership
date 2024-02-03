<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\TrainerFormRequest;
use App\Models\User;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::all();
        return view('admin.trainer.index', compact('trainers'));
    }
    public function create()
    {
        return view('admin.trainer.create');
    }
    public function store(TrainerFormRequest $request)
    {
        $validatedData = $request->validated();
        $trainer = new Trainer();
        $trainer->name = $validatedData['name'];
        $trainer->description = $validatedData['description'];
        $trainer->fb_name = $validatedData['fb_name'];
        $trainer->twitter_name = $validatedData['twitter_name'];
        $trainer->linkin_name = $validatedData['linkin_name'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/trainer/', $filename);
            $trainer->image = $filename;
        }
        $trainer->save();
        return redirect('admin/trainers')->with(
            'message',
            'Trainer Added Successfully'
        );
    }
    public function edit(Trainer $trainer)
    {
        return view('admin.trainer.edit', compact('trainer'));
    }

    public function update(TrainerFormRequest $request, $trainer)
    {
        $validatedData = $request->validated();
        $trainer = Trainer::findOrFail($trainer);

        $trainer->name = $validatedData['name'];
        $trainer->description = $validatedData['description'];
        $trainer->fb_name = $validatedData['fb_name'];
        $trainer->twitter_name = $validatedData['twitter_name'];
        $trainer->linkin_name = $validatedData['linkin_name'];

        if ($request->hasFile('image')) {
            $path = public_path('uploads/trainer/' . $trainer->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/trainer/', $filename);
            $trainer->image = $filename;
        }
        $trainer->update();
        return redirect('admin/trainers')->with(
            'message',
            'Trainer Updated Successfully'
        );
    }
    public function destroy($trainer_id)
    {
        $trainer = Trainer::findOrFail($trainer_id);
        $path = public_path('uploads/trainer/' . $trainer->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        $trainer->delete();
        return redirect('admin/trainers')->with(
            'message',
            'Trainer Deleted Successfully'
        );
    }

    public function organizationChart()
    {
        $staffs = User::where('role_as', 5)->with('position')->get();
        return view('admin.dashboard.organization_chart',['staffs'=> $staffs]);
    }
}
