<?php

namespace App\Http\Livewire\Admin\Request;

use Livewire\Component;
use App\Models\Products;
use App\Models\ShopKeeper;
use App\Http\Requests\Delivery\DeliveryRequestForm;

class Index extends Component
{
    public $clickEventType;
    public $tableData = [];
    public $start_date,
        $end_date,
        $description,
        $product_id,
        $quantity,
        $kg,
        $deli_cost,
        $deli_type_id;

    public function rules()
    {
        return [
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
            'description' => ['required', 'string'],
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'kg' => ['required', 'integer'],
            'deli_cost' => ['required', 'integer'],
            'deli_type_id' => ['required', 'integer'],
        ];
    }

    public function resetInput()
    {
        $this->start_date = null;
        $this->end_date = null;
        $this->description = null;
        $this->product_id = null;
        $this->quantity = null;
        $this->kg = null;
        $this->deli_cost = null;
        $this->deli_type_id = null;
    }

    public function storeDeliveryRequest()
    {
        $validatedData = $this->validate();
        dd($validatedData);
        // Brand::create([
        //     'name' => $validatedData['name'],
        //     'slug' => Str::slug($validatedData['slug']),
        // ]);
        // session()->flash('message', 'Brand Added Successfully');
        // $this->dispatchBrowserEvent('close-modal');
        // $this->resetInput();
    }
    public function refreshTable()
    {
        $this->tableData = ShopKeeper::all();
        $this->emit('refreshDataTable');
    }
    public function clickEvt($clickType)
    {
        switch ($clickType) {
            case 1:
                $this->tableData = ShopKeeper::all();
                break;
            case 2:
                $this->tableData = Products::all();
                break;
            case 3:
                $this->tableData = ShopKeeper::all();
                break;
            default:
                $this->tableData = ShopKeeper::all();
        }
    }

    public function render()
    {
        $data['requests'] = $this->tableData;
        $data['products'] = Products::get();
        $data['deliTypes'] = Products::get();
        return view('livewire.admin.request.index', $data);
    }
}
