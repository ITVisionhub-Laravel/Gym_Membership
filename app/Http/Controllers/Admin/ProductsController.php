<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $data['products'] = Products::get();
        return view('admin.products.index', $data);
    }

    public function create()
    {
        $data['brands'] = Brand::get();
        $data['categories'] = Category::get();

        return view('admin.products.create', $data);
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $product = new Products();
        $product->brand_id = $validatedData['brand_id'];
        $product->category_id = $validatedData['category_id'];
        $product->name = $validatedData['name'];
        $product->slug = $validatedData['slug'];
        $product->buying_price = $validatedData['buying_price'];
        $product->selling_price = $validatedData['selling_price'];

        $product->quantity = $validatedData['quantity'];
        $product->small_description = $validatedData['small_description'];
        $product->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $product->image = "uploads/products/$filename";
        }
        $product->save();

        return redirect('admin/products')->with(
            'message',
            'Products Added Successfully'
        );
    }

    public function edit(Products $product)
    {
        $data['brands'] = Brand::get();
        $data['categories'] = Category::get();
        return view('admin.products.edit', compact('product'), $data);
    }

    public function update(ProductFormRequest $request, $product)
    {
        $validatedData = $request->validated();
        $product = Products::findOrFail($product);
        $product->brand_id = $validatedData['brand_id'];
        $product->category_id = $validatedData['category_id'];
        $product->name = $validatedData['name'];
        $product->slug = $validatedData['slug'];
        $product->buying_price = $validatedData['buying_price'];
        $product->selling_price = $validatedData['selling_price'];

        $product->quantity = $validatedData['quantity'];
        $product->small_description = $validatedData['small_description'];
        $product->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $path = public_path($product->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $product->image = 'uploads/products/' . $filename;
        }
        $product->update();
        return redirect('admin/products')->with(
            'message',
            'Product Updated Successfully'
        );
    }

    public function destroy($product_id)
    {
        $product = Products::findOrFail($product_id);
        $path = public_path($product->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        $product->delete();
        return redirect('admin/products')->with(
            'message',
            'Product Deleted Successfully'
        );
    }
}
