<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\ShopType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Http\Requests\Shop\ShopTypeFormRequest;
use App\Http\Requests\Shop\ShopType as ShopShopType;

class ShopTypeController extends Controller
{
    public function index()
    {
        $data['shoptypes'] = ShopType::get();
        return view('admin.shoptypes.index', $data);
    }

    public function create()
    {
        return view('admin.shoptypes.create');
    }

    public function store(ShopTypeFormRequest $request)
    {
        $validatedData = $request->validated();
        $brand = new ShopType();
        $brand->name = $validatedData['name'];
        $brand->slug = $validatedData['slug'];

        $brand->save();

        return redirect('admin/shoptypes')->with(
            'message',
            'Brand Added Successfully'
        );
    }

    public function edit(ShopType $brand)
    {
        return view('admin.shoptypes.edit', compact('brand'));
    }

    public function update(BrandFormRequest $request, $brand)
    {
        $validatedData = $request->validated();
        $brand = ShopType::findOrFail($brand);

        $brand->name = $validatedData['name'];
        $brand->slug = $validatedData['slug'];

        $brand->update();
        return redirect('admin/shoptypes')->with(
            'message',
            'Brands Updated Successfully'
        );
    }

    public function destroy($brand_id)
    {
        $brand = ShopType::findOrFail($brand_id);
        $brand->delete();
        return redirect('admin/shoptypes')->with(
            'message',
            'Brand Deleted Successfully'
        );
    }
}
