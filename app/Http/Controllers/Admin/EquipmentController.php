<?php

namespace App\Http\Controllers\Admin;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\EquipmentFormRequest;
use Illuminate\Support\Facades\File;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();
        return view('admin.equipment.index', compact('equipments'));
    }

    public function create()
    {
        return view('admin.equipment.create');
    }

    // public function store(EquipmentFormRequest $request)
    // {
    //     // dd($request);
    //     $validatedData = $request->validated();

    //     $equipment = new Equipment();
    //     $equipment->name = $validatedData['name'];

    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $ext;

    //         $file->move('uploads/equipment/', $filename);
    //         $validatedData['image'] = "uploads/equipment/$filename";
    //         // dd($validatedData['image']);
    //     }
    //     $equipment->save();
    //     // dd($equipment->save());
    //     return redirect('admin/equipments')->with(
    //         'message',
    //         'Equipment Added Successfully'
    //     );
    // }

    // public function edit(Equipment $equipment)
    // {
    //     //return $equipment;
    //     return view('admin.equipment.edit', compact('equipment'));
    // }

    // public function update(EquipmentFormRequest $request, $equipment)
    // {
    //     $validatedData = $request->validated();

    //     $equipment = Equipment::findOrFail($equipment);

    //     $equipment->name = $validatedData['name'];

    //     if ($request->hasFile('image')) {
    //         $path = public_path('uploads/equipment/' . $equipment->image);
    //         if (File::exists($path)) {
    //             File::delete($path);
    //         }
    //         $file = $request->file('image');
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $ext;

    //         $file->move('uploads/equipment/', $filename);
    //         $validatedData['image'] = "uploads/equipment/$filename";
    //     }
    //     $equipment->update();
    //     return redirect('admin/equipments')->with(
    //         'message',
    //         'Equipment Updated Successfully'
    //     );
    // }

    // public function destroy($equipment_id)
    // {
    //     $equipment = Equipment::findOrFail($equipment_id);
    //     $path = public_path('uploads/equipment/' . $equipment->image);
    //     if (File::exists($path)) {
    //         File::delete($path);
    //     }
    //     $equipment->delete();
    //     return redirect('admin/equipments')->with(
    //         'message',
    //         'Equipment Deleted Successfully'
    //     );
    // }

    public function store(EquipmentFormRequest $request)
    {
        $validatedData = $request->validated();
        $equipment = new Equipment();
        $equipment->name = $validatedData['name'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/equipment/', $filename);
            $equipment->image = $filename;
        }
        $equipment->save();
        return redirect('admin/equipments')->with(
            'message',
            'Equipment Added Successfully'
        );
    }

    public function edit(Equipment $equipment)
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    public function update(EquipmentFormRequest $request, $equipment)
    {
        $validatedData = $request->validated();
        $equipment = Equipment::findOrFail($equipment);

        $equipment->name = $validatedData['name'];

        if ($request->hasFile('image')) {
            $path = public_path('uploads/equipment/' . $equipment->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/equipment/', $filename);
            $equipment->image = $filename;
        }
        $equipment->update();
        return redirect('admin/equipments')->with(
            'message',
            'Equipment Updated Successfully'
        );
    }

    public function destroy($equipment_id)
    {
        $equipment = Equipment::findOrFail($equipment_id);
        $path = public_path('uploads/equipment/' . $equipment->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        $equipment->delete();
        return redirect('admin/equipments')->with(
            'message',
            'Equipment Deleted Successfully'
        );
    }
}
