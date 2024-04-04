<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        $partners=Partner::all();
        if (request()->expectsJson()) {
            return PartnerResource::collection($partners);
        }
        return view('admin.partner.index',compact('partners'));
    }
    public function create()
    {
        return view('admin.partner.create');
    }
    public function store(PartnerRequest $request, Partner $partner)
    {
        $validatedData = $request->validated();
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $ext;
        //     $file->move('uploads/partner/', $filename);
        //     $validatedData['image'] = "uploads/partner/$filename";
        // }
        // Partner::create([
        //     'name'=>$validatedData['name'],
        //     'image' => $validatedData['image']
        // ]);


        $partner->fill($validatedData);

        $this->uploadImage($request, $partner, 'partner');

        $partner->save();

        if (request()->expectsJson()) {
            return new PartnerResource($partner);
        }

        return redirect('admin/partner')->with(
            'message',
            'Partner Added Successfully'
        );
    }
    public function edit(Partner $partner)
    {
        return view('admin.partner.edit',compact('partner'));
    }
    public function update(PartnerRequest $request, Partner $partner)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $destination = public_path($partner->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/partner/', $filename);
            $validatedData['image'] = "uploads/partner/$filename";
        }
        Partner::where('id', $partner->id)->update([
            'name'=>$validatedData['name'],
            'image' => $validatedData['image'] ?? $partner->image
        ]);

        if (request()->expectsJson()) {
            return new PartnerResource($partner);
        }

        return redirect('admin/partner')->with(
            'message',
            'Partner Updated Successfully'
        );
    }
    public function destroy(Partner $partner)
    {
        if ($partner->count() > 0) {
            $destination = $partner->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $partner->delete();
            
            if (request()->expectsJson()) {
                return new PartnerResource($partner);
            }
            return redirect('admin/partner')->with(
                'message',
                'Partner Deleted Successfully'
            );
        }
        return redirect('admin/partner')->with(
            'message',
            'Something Went Wrong'
        );
    }
}
