<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\ShopType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        $shoptype = new ShopType();
        $shoptype->name = $validatedData['name'];
        $shoptype->email = $validatedData['email'];
        $shoptype->address = $validatedData['address'];
        $shoptype->phone = $validatedData['phone'];
        $shoptype->hot_line = $validatedData['hot_line'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/shoptypes/', $filename);
            $shoptype->image = "uploads/shoptypes/$filename";
        }
        $shoptype->save();

        return redirect('admin/shoptypes')->with(
            'message',
            'Shoptype Added Successfully'
        );
    }

    public function edit(ShopType $shoptype)
    {
        return view('admin.shoptypes.edit', compact('shoptype'));
    }

    public function update(ShopTypeFormRequest $request, $shoptype)
    {
        $validatedData = $request->validated();
        $shoptype = ShopType::findOrFail($shoptype);

        $shoptype->name = $validatedData['name'];
        $shoptype->email = $validatedData['email'];
        $shoptype->address = $validatedData['address'];
        $shoptype->phone = $validatedData['phone'];
        $shoptype->hot_line = $validatedData['hot_line'];
        if ($request->hasFile('image')) {
            $path = public_path('uploads/shoptypes/' . $shoptype->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/shoptypes/', $filename);
            $shoptype->image = $filename;
        }
        $shoptype->update();
        return redirect('admin/shoptypes')->with(
            'message',
            'ShopType Updated Successfully'
        );
    }

    public function destroy($shoptype_id)
    {
        $shoptype = ShopType::findOrFail($shoptype_id);
        $shoptype->delete();
        return redirect('admin/shoptypes')->with(
            'message',
            'Brand Deleted Successfully'
        );
    }
}
