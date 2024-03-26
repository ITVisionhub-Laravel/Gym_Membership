<?php

namespace App\Http\Controllers\Admin\Shop;
use App\Models\Shop;
use App\Models\Products;
use App\Models\ShopType;
use App\Models\ShopKeeper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopFormRequest;
use App\Http\Requests\Shop\ShopKeeperRequest;

class ShopController extends Controller
{
    public function index()
    {
        $data['shops'] = Shop::get();
        return view('admin.shops.index', $data);
    }

    public function create()
    {
        return view('admin.shops.create');
    }

    public function store(ShopFormRequest $request)
    {
        $validatedData = $request->validated();
        $shop = new Shop();
        $product_id = $validatedData['product_id'];
        if (Shop::where('product_id', $product_id)->exists()) {
            $originalShopData = Shop::where('product_id', $product_id)->first();
            $originalShopData->increment(
                'quantity',
                (int) $validatedData['quantity']
            );
        } else {
            $shop->product_id = $product_id;
            $shop->quantity = $validatedData['quantity'];
            $shop->shop_type_id = $validatedData['shop_type_id'];

            $shop->save();
        }

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
        return redirect('admin/shops')->with(
            'message',
            'Shop Updated Successfully'
        );
    }

    public function destroy($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        $shop->delete();
        return redirect('admin/shops')->with(
            'message',
            'Shop Deleted Successfully'
        );
    }
}