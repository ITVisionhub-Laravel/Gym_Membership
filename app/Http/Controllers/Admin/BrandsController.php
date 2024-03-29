<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Http\Resources\BrandsResource;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::get();
        // $data['brands'] = Brand::get();
        if (request()->expectsJson()) {
            return BrandsResource::collection($brands);
        }
        return view('admin.brands.index', compact('brands'));
        // return view('admin.brands.index', $data);
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

        if (request()->expectsJson()) {
            return new BrandsResource($brand);
        }

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

        if (request()->expectsJson()) {
            return new BrandsResource($brand);
        }

        return redirect('admin/brands')->with(
            'message',
            'Brands Updated Successfully'
        );
    }

    public function destroy($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $brand->delete();

        if (request()->expectsJson()) {
            return new BrandsResource($brand);
        }
        
        return redirect('admin/brands')->with(
            'message',
            'Brand Deleted Successfully'
        );
    }
}
