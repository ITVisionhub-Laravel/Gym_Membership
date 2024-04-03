<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogoRequest;
use App\Http\Resources\LogoResource;
use App\Models\Logo;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\File;

class LogoController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        $logos = Logo::all();
        if (request()->expectsJson()) {
            return LogoResource::collection($logos);
        }
        return view('admin.logo.index', compact('logos'));
    }
    public function create()
    {
        return view('admin.logo.create');
    }

    public function store(LogoRequest $request,Logo $logo)
    {
        $validatedData = $request->validated();
        // $validatedData = $request->validate([
        //     'name' => ['string'],
        //     'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        //     'description' => ['required', 'string'],
        //     'location' => ['required', 'string'],
        //     'address_id' => ['required', 'string'],
        //     'ph_no' => ['required', 'string'],
        //     'email' => ['required', 'string'],
        //     'open_day' => ['required', 'string'],
        //     'open_time' => ['required', 'string'],
        //     'close_day' => ['required', 'string'],
        // ]);
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $ext;
        //     $file->move('uploads/logo/', $filename);
        //     $validatedData['image'] = "uploads/logo/$filename";
        // }

        $logo->fill($validatedData);

        $this->uploadImage($request, $logo, 'logo');

        $logo->save();

        // $logoData = Logo::create([
        //     'name' => $validatedData['name'],
        //     'image' => $validatedData['image'],
        //     'description' => $validatedData['description'],
        //     'location' => $validatedData['location'],
        //     'address' => $validatedData['address'],
        //     'ph_no' => $validatedData['ph_no'],
        //     'email' => $validatedData['email'],
        //     'open_day' => $validatedData['open_day'],
        //     'open_time' => $validatedData['open_time'],
        //     'close_day' => $validatedData['close_day'],
        // ]);

        if (request()->expectsJson()) {
            return new LogoResource($logo);
        }
        return redirect('admin/logo')->with(
            'message',
            'Logo Added Successfully'
        );
    }
    public function edit(Logo $logo)
    {
        return view('admin.logo.edit', compact('logo'));
    }

    public function update(LogoRequest $request, Logo $logo)
    {
        $validatedData = $request->validated();

        // $validatedData = $request->validate([
        //     'name' => ['string'],
        //     'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        //     'description' => ['required', 'string'],
        //     'location' => ['required', 'string'],
        //     'address_id' => ['required', 'string'],
        //     'ph_no' => ['required', 'string'],
        //     'email' => ['required', 'string'],
        //     'open_day' => ['required', 'string'],
        //     'open_time' => ['required', 'string'],
        //     'close_day' => ['required', 'string'],
        // ]);

        // if ($request->hasFile('image')) {
        //     $destination = public_path($logo->image);
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $ext;
        //     $file->move('uploads/logo/', $filename);
        //     $validatedData['image'] = "uploads/logo/$filename";
        // }

        $logo->fill($validatedData);
        
        $this->uploadImage($request, $logo, 'logo');

        $logo->update($validatedData);

        // logo::where('id', $logo->id)->update([
        //     'name' => $validatedData['name'],
        //     'image' => $validatedData['image'] ?? $logo->image,
        //     'description' => $validatedData['description'],
        //     'location' => $validatedData['location'],
        //     'address' => $validatedData['address'],
        //     'ph_no' => $validatedData['ph_no'],
        //     'email' => $validatedData['email'],
        //     'open_day' => $validatedData['open_day'],
        //     'open_time' => $validatedData['open_time'],
        //     'close_day' => $validatedData['close_day'],
        // ]);

        if (request()->expectsJson()) {
            return new LogoResource($logo);
        }

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

            if (request()->expectsJson()) {
                return new LogoResource($logo);
            }

            return redirect('admin/logo')->with(
                'message',
                'Logo Deleted Successfully'
            );
        }
        return redirect('admin/logo')->with('message', 'Something Went Wrong');
    }
}
