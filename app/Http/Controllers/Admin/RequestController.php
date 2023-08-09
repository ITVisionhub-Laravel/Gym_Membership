<?php

namespace App\Http\Controllers\Admin;
use App\Models\ShopKeeper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopKeeperRequest;
use App\Models\RequestProduct;

class RequestController extends Controller
{
    public function index()
    {
        $data['shopKeeperRequests'] = RequestProduct::where('status', 0)->get();
        // dd($data);
        return view('admin.request.index', $data);
    }

    public function store(ShopKeeperRequest $request)
    {
        $validatedData = $request->validated();
        $shopKeeper = new ShopKeeper();

        $shopKeeperProduct = ShopKeeper::where(
            'product_id',
            $validatedData['product_id']
        )
            ->where('shop_type_id', $validatedData['shop_type_id'])
            ->where('status', 0)
            ->first();

        if ($shopKeeperProduct) {
            // The product with the given product ID and shop ID exists
            $shopKeeper->increment(
                'quantity',
                (int) $validatedData['quantity']
            );
        } else {
            // The product with the given product ID and shop ID does not exist
            $shopKeeper->product_id = $validatedData['product_id'];
            $shopKeeper->quantity = $validatedData['quantity'];
            $shopKeeper->shop_type_id = $validatedData['shop_type_id'];
            $shopKeeper->save();
        }

        return redirect('admin/shops')->with(
            'message',
            'Shop Added Successfully'
        );
    }
}
