<?php

namespace App\Http\Controllers\Admin\Shop;
use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopFormRequest;
use App\Models\Products;
use App\Models\ShopType;

class ShopController extends Controller
{
    public function index()
    {
        $data['shops'] = Shop::get();
        return view('admin.shops.index', $data);
    }

    public function create()
    {
        $data['shopTypes'] = ShopType::get();
        $data['products'] = Products::get();
        return view('admin.shops.create', $data);
    }

    public function store(ShopFormRequest $request)
    {
        $validatedData = $request->validated();
        $shop = new Shop();
        $shop->product_id = $validatedData['product_id'];
        $shop->quantity = $validatedData['quantity'];
        $shop->shop_type_id = $validatedData['shop_type_id'];

        $shop->save();

        return redirect('admin/shops')->with(
            'message',
            'Shop Added Successfully'
        );
    }

    public function edit(Shop $shop)
    {
        $data['shopTypes'] = ShopType::get();
        $data['products'] = Products::get();
        return view('admin.shops.edit', compact('shop'), $data);
    }

    public function update(ShopFormRequest $request, $shop)
    {
        $validatedData = $request->validated();
        $shop = Shop::findOrFail($shop);

        $shop->product_id = $validatedData['product_id'];
        $shop->quantity = $validatedData['quantity'];
        $shop->shop_type_id = $validatedData['shop_type_id'];

        $shop->update();
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
