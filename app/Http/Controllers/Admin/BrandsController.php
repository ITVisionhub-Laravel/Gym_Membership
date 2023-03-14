<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;

class BrandsController extends Controller
{
    public function index()
    {
        $data['brands'] = Brand::get();
        return view('admin.brands.index', $data);
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandFormRequest $request)
    {
        $validatedData = $request->validated();
        $brand = new Brand();
        $brand->name = $validatedData['name'];
        $brand->slug = $validatedData['slug'];

        $brand->save();

        return redirect('admin/brands')->with(
            'message',
            'Brand Added Successfully'
        );
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandFormRequest $request, $brand)
    {
        $validatedData = $request->validated();
        $brand = Brand::findOrFail($brand);

        $brand->name = $validatedData['name'];
        $brand->slug = $validatedData['slug'];

        $brand->update();
        return redirect('admin/brands')->with(
            'message',
            'Brands Updated Successfully'
        );
    }

    public function destroy($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $brand->delete();
        return redirect('admin/brands')->with(
            'message',
            'Brand Deleted Successfully'
        );
    }
}
