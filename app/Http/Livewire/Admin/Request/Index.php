<?php

namespace App\Http\Livewire\Admin\Request;

use App\Models\Products;
use Livewire\Component;
use App\Models\ShopKeeper;

class Index extends Component
{
    public $clickEventType;
    public $tableData = [];
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
        return view('livewire.admin.request.index', $data);
    }
}
