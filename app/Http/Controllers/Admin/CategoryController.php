<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::get();
        return view('admin.categories.index', $data);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = $validatedData['slug'];
        $category->description = $validatedData['description'];
        $category->small_description = $validatedData['small_description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/categories/', $filename);
            $category->image = "uploads/categories/$filename";
        }
        $category->save();

        return redirect('admin/categories')->with(
            'message',
            'Category Added Successfully'
        );
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->slug = $validatedData['slug'];
        $category->description = $validatedData['description'];
        $category->small_description = $validatedData['small_description'];

        if ($request->hasFile('image')) {
            $path = public_path($category->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/categories/', $filename);
            $category->image = 'uploads/categories/' . $filename;
        }
        $category->update();
        return redirect('admin/categories')->with(
            'message',
            'Category Updated Successfully'
        );
    }

    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);
        $path = public_path($category->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete();
        return redirect('admin/categories')->with(
            'message',
            'Category Deleted Successfully'
        );
    }
}
