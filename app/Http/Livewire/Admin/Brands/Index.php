<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $brand_id;

    public function rules()
    {
        @dd('rule');
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
        ];
    }

    public function resetInput()
    {
        @dd('input');
        $this->name = null;
        $this->slug = null;
        $this->brand_id = null;
    }

    public function storeBrand()
    {
        @dd('storeBrand');
        $validatedData = $this->validate();
        @dd('hello');
        Brand::create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
        ]);
        session()->flash('message', 'Brand Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        @dd('close');
        $this->resetInput();
    }

    public function openModal()
    {
        @dd('open');
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        @dd('edit');
        @dd($brand_id);
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
    }

    public function updateBrand()
    {
        @dd('update');
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
        ]);
        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        @dd('delete');
        $this->brand_id = $brand_id;
    }

    public function destoryBrand()
    {
        @dd('destory');
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brands.index', [
            'brands' => $brands,
        ])->layout('components.admin');
    }
}
