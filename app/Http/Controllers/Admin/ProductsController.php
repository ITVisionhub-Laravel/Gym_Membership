<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use Illuminate\Http\Request;
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
        return view('admin.products.create');
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $product = new Products();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];

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
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductFormRequest $request, $product)
    {
        $validatedData = $request->validated();
        $product = Products::findOrFail($product);

        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];

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
