<?php

namespace App\Http\Controllers\Admin\Shop;
use App\Models\Shop;
use App\Models\Products;
use App\Models\ShopType;
use App\Models\ShopKeeper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopFormRequest;
use App\Http\Requests\Shop\ShopKeeperRequest;
use App\Http\Resources\ShopResource;
use Illuminate\Support\Facades\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::get();
        // $data['shops'] = Shop::get();
        if(request()->expectsJson())
        {
            return ShopResource::collection($shops);
        }
        return view('admin.shops.index', compact('shops'));
        // return view('admin.shops.index', $data);
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
        $shopProductData = Shop::where('product_id', $product_id);
        if ($shopProductData->exists()) {
            $originalShopData = $shopProductData->first();
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

        if (!request()->expectsJson()) {
            return redirect('admin/shops')->with(
                'message',
                'Shop Added Successfully'
            );
        }
        $shopData = $shopProductData ?  $originalShopData :  $shop;

        return new ShopResource($shopData);
        
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
        if (!request()->expectsJson()) {
            return redirect('admin/shops')->with(
                'message',
                'Shop Updated Successfully'
            );
        }
        return new ShopResource($shop);
    }

    public function destroy($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        $shop->delete();
        if (!request()->expectsJson()) {
            return redirect('admin/shops')->with(
                'message',
                'Shop Deleted Successfully'
            );
        }
        return new ShopResource($shop);
    }
}