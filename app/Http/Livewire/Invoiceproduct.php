<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Invoiceproduct extends Component
{
    public $invoiceProducts;

    // protected $listeners = ['cartAddedUpdated' => 'checkInvoiceProductlist'];

    public function checkInvoiceProductlist()
    {
        if (Auth::check()) {
            return $this->invoiceProducts = Cart::where(
                'customer_id',
                auth()->user()->customers->id
            )->get();
        } else {
            return $this->invoiceProducts = 0;
        }
    }

    public function render()
    {
        $this->invoiceProducts = $this->checkInvoiceProductlist();
        return view('livewire.invoiceproduct', [
            'invoiceProducts' => $this->invoiceProducts,
        ]);
    }
}
