<?php

namespace App\Http\Livewire\Admin\Request;

use Livewire\Component;
use App\Models\Products;
use App\Models\ShopKeeper;
use App\Models\DeliveryType;
use App\Models\Delivery;
use App\Models\RequestProduct;
use App\Models\Shop;
use App\Models\ShopProducts;
use App\Models\ShopType;
use App\Models\WareHouseRequest;

class Index extends Component
{
    public $clickEventType = 1;
    public $tableData = [];
    public $unitId;
    public $start_date,
        $end_date,
        $description,
        $product_id,
        $quantity,
        $total_kg,
        $total_cost,
        $deli_kg,
        $deli_cost,
        $deli_type_id,
        $shop_type_id;

    // protected $listeners = ['closeModal'];

    public function mount()
    {
        $this->clickEvt(1);
    }

    public function refreshData($data)
    {
        $this->emit('tableUpdated');
        // fetch the latest data and update the component's data property
        $this->tableData = $data;
    }

    public function rules()
    {
        if ($this->clickEventType == 1) {
            return [
                'start_date' => ['nullable'],
                'end_date' => ['nullable'],
                'description' => ['required', 'string'],
                'product_id' => ['required', 'integer'],
                'quantity' => ['required', 'integer'],
                'shop_type_id' => ['required', 'integer'],
                'total_kg' => ['nullable', 'integer'],
                'total_cost' => ['nullable', 'integer'],
                'deli_kg' => ['nullable', 'integer'],
                'deli_cost' => ['nullable', 'integer'],
                'deli_type_id' => ['nullable', 'integer'],
            ];
        } elseif ($this->clickEventType == 3) {
            return [
                'start_date' => ['nullable'],
                'end_date' => ['nullable'],
                'description' => ['nullable', 'string'],
                'product_id' => ['required', 'integer'],
                'quantity' => ['required', 'integer'],
                'shop_type_id' => ['required', 'integer'],
                'total_kg' => ['nullable', 'integer'],
                'total_cost' => ['nullable', 'integer'],
                'deli_kg' => ['nullable', 'integer'],
                'deli_cost' => ['nullable', 'integer'],
                'deli_type_id' => ['nullable', 'integer'],
            ];
        } else {
            return [
                'start_date' => ['nullable'],
                'end_date' => ['nullable'],
                'description' => ['required', 'string'],
                'product_id' => ['required', 'integer'],
                'quantity' => ['required', 'integer'],
                'total_kg' => ['required', 'integer'],
                'total_cost' => ['required', 'integer'],
                'deli_kg' => ['required', 'integer'],
                'deli_cost' => ['required', 'integer'],
                'deli_type_id' => ['required', 'integer'],
                'shop_type_id' => ['required', 'integer'],
            ];
        }
    }

    public function resetInput()
    {
        $this->start_date = null;
        $this->end_date = null;
        $this->description = null;
        $this->product_id = null;
        $this->quantity = null;
        $this->total_kg = null;
        $this->total_cost = null;
        $this->deli_kg = null;
        $this->deli_cost = null;
        $this->deli_type_id = null;
        $this->shop_type_id = null;
    }

    public function approveWarehouseRequest($request)
    {
        $this->unitId = $request['id'];
        $this->description = $request['description'];
        $this->product_id = $request['product_id'];
        $this->shop_type_id = $request['shop_type_id'];
        $this->quantity = $request['quantity'];
        $this->deli_type_id = $request['deli_type_id'];
        $deliInfo = DeliveryType::where('id', $this->deli_type_id)->first();
        $this->deli_kg = $deliInfo->kg;
        $this->deli_cost = $deliInfo->cost;
    }

    public function calculateDeliCost()
    {
        if (empty($this->total_kg)) {
            $this->total_cost = 0;
        } else {
            $this->total_cost = $this->total_kg * $this->deli_cost;
        }
    }

    public function storeWarehouseRequestToDeliveryMan()
    {
        $validatedData = $this->validate();
        $deliveryManRequestCreate = new Delivery();
        $deliveryManData = Delivery::where(
            'product_id',
            $validatedData['product_id']
        )
            ->where('shop_type_id', $validatedData['shop_type_id'])
            ->where('status', 0)
            ->first();

        if ($deliveryManData) {
            // The product with the given product ID and shop ID exists
            $deliveryManRequestIncrement = $deliveryManRequestCreate->increment(
                'quantity',
                (int) $validatedData['quantity']
            );
            if ($deliveryManRequestIncrement) {
                RequestProduct::where('id', $this->unitId)->update([
                    'status' => 1,
                ]);
            }
        } else {
            // The product with the given product ID and shop ID does not exist
            $deliveryManCreate = $deliveryManRequestCreate->Create([
                'product_id' => $validatedData['product_id'],
                'shop_type_id' => $validatedData['shop_type_id'],
                'status' => 0,
                'start_date' => '',
                'end_date' => '',
                'description' => $validatedData['description'],
                'quantity' => $validatedData['quantity'],
                'kg' => $validatedData['total_kg'],
                'deli_cost' => $validatedData['total_cost'],
                'deli_type_id' => $validatedData['deli_type_id'],
            ]);
            if ($deliveryManCreate) {
                RequestProduct::where('id', $this->unitId)->update([
                    'status' => 1,
                ]);
            }
        }

        session()->flash('message', 'DeliveryMan Request Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $data = RequestProduct::where('status', 0)->get();
        $this->refreshData($data);
    }

    public function approveShopKeeperRequest($request)
    {
        $this->unitId = $request['id'];
        $this->product_id = $request['product_id'];
        $this->shop_type_id = $request['shop_type_id'];
        $this->quantity = $request['quantity'];
    }
    public function storeShopKeeperRequestToWarehouse()
    {
        $validatedData = $this->validate();
        $warehouseRequestCreate = new RequestProduct();
        $warehouseRequestData = RequestProduct::where(
            'product_id',
            $validatedData['product_id']
        )
            ->where('shop_type_id', $validatedData['shop_type_id'])
            ->where('status', 0)
            ->first();
        if ($warehouseRequestData) {
            // The product with the given product ID and shop ID exists
            $warehouseRequestIncrement = $warehouseRequestCreate->increment(
                'quantity',
                (int) $validatedData['quantity']
            );
            if ($warehouseRequestIncrement) {
                ShopProducts::where('id', $this->unitId)->update([
                    'status' => 1,
                ]);
            }
        } else {
            $warehouseCreate = $warehouseRequestCreate->Create([
                'product_id' => $validatedData['product_id'],
                'shop_type_id' => $validatedData['shop_type_id'],
                'status' => 0,
                'description' => $validatedData['description'],
                'quantity' => $validatedData['quantity'],
                'deli_type_id' => $validatedData['deli_type_id'],
            ]);
            if ($warehouseCreate) {
                ShopProducts::where('id', $this->unitId)->update([
                    'status' => 1,
                ]);
            }
        }

        session()->flash('message', 'ShopKeeper Request Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $data = RequestProduct::where('status', 0)->get();
        $this->refreshData($data);
    }

    public function approveDeliveryRequest($request)
    {
        $this->unitId = $request['id'];
        $this->product_id = $request['product_id'];
        $this->shop_type_id = $request['shop_type_id'];
        $this->quantity = $request['quantity'];
    }

    public function storeDeliveryRequestToShop()
    {
        $validatedData = $this->validate();
        $shop = new Shop();
        $shopData = Shop::where(
            'product_id',
            $validatedData['product_id']
        )->first();
        if ($shopData) {
            // The product with the given product ID and shop ID exists
            $shopProductIncrement = $shop->increment(
                'quantity',
                (int) $validatedData['quantity']
            );
            if ($shopProductIncrement) {
                Delivery::where('id', $this->unitId)->update(['status' => 1]);
            }
        } else {
            $shopCreate = $shop->Create([
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
                'shop_type_id' => $validatedData['shop_type_id'],
            ]);
            if ($shopCreate) {
                Delivery::where('id', $this->unitId)->update(['status' => 1]);
            }
        }

        session()->flash('message', 'Delivery Request Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $data = Delivery::where('status', 0)->get();
        $this->refreshData($data);
    }
    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function clickEvt($clickType)
    {
        switch ($clickType) {
            case 1:
                $this->tableData = RequestProduct::where('status', 0)->get();
                $this->clickEventType = $clickType;
                $this->emit('tableUpdated');
                break;
            case 2:
                $this->tableData = RequestProduct::where('status', 0)->get();
                $this->clickEventType = $clickType;
                $this->emit('tableUpdated');
                break;
            case 3:
                $this->tableData = Delivery::where('status', 0)->get();
                $this->clickEventType = $clickType;
                $this->emit('tableUpdated');
                break;
            default:
                $this->tableData = RequestProduct::where('status', 0)->get();
                $this->clickEventType = 1;
        }
    }

    public function render()
    {
        $data['requests'] = $this->tableData;
        $data['clickEvent'] = $this->clickEventType;
        $data['products'] = Products::get();
        $data['deliTypes'] = DeliveryType::get();
        $data['shopTypes'] = ShopType::get();
        return view('livewire.admin.request.index', $data);
    }
}
