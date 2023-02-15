<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogoController extends Controller
{
    public function index()
    {
        $logos=Logo::all();
        return view('admin.logo.index',compact('logos'));
    }
    public function create()
    {
        return view('admin.logo.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png']
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $validatedData['image'] = "uploads/logo/$filename";
        }
        Logo::create([
            'image' => $validatedData['image']
        ]);
        return redirect('admin/logo')->with(
            'message',
            'Logo Added Successfully'
        );
    }
    public function edit(Logo $logo)
    {
        return view('admin.logo.edit', compact('logo'));
    }

    public function update(Request $request, Logo $logo)
    {
        $validatedData = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png']
        ]);
        if ($request->hasFile('image')) {
            $destination = public_path($logo->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $validatedData['image'] = "uploads/logo/$filename";
        }
    logo::where('id', $logo->id)->update([
            'image' => $validatedData['image'] ?? $logo->image
        ]);
        return redirect('admin/logo')->with(
            'message',
            'Logo Updated Successfully'
        );
    }

    public function destroy(Logo $logo)
    {
        if ($logo->count() > 0) {
            $destination = $logo->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $logo->delete();

            return redirect('admin/logo')->with(
                'message',
                'Logo Deleted Successfully'
            );
        }
        return redirect('admin/logo')->with(
            'message',
            'Something Went Wrong'
        );
    }
}
