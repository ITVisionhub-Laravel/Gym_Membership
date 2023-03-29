<?php

namespace App\Http\Controllers\Admin;
use App\Models\ShopKeeper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopKeeperRequest;
use App\Models\ShopKeeperRequest as ModelsShopKeeperRequest;

class RequestController extends Controller
{
    public function index()
    {
        $data['shopKeeperRequests'] = ShopKeeper::all();
        return view('admin.request.index', $data);
    }

    public function store(ShopKeeperRequest $request)
    {
        $validatedData = $request->validated();
        $shopKeeper = new ShopKeeper();

        $shopKeeper->product_id = $validatedData['product_id'];
        $shopKeeper->quantity = $validatedData['quantity'];
        // $shopKeeper->status = $validatedData['quantity'];
        $shopKeeper->shop_type_id = $validatedData['shop_type_id'];

        $shopKeeper->save();

        return redirect('admin/shops')->with(
            'message',
            'Shop Added Successfully'
        );
    }
}
