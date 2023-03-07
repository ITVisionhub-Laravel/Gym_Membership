<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Logo;
use App\Models\Partner;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class ProductCheckout extends Component
{
    public $cart,
        $products,
        $customer,
        $invoiceProducts,
        $totalPrice = 0;
    public $showDiv = false;

    public function addToCart($productId)
    {
        $this->products = Products::where('id', $productId)->first();
        $this->customer = Customer::where(
            'email',
            auth()->user()->email
        )->first();
        // @dd(auth()->user()->id);

        if (Auth::check()) {
            if (
                Cart::where('customer_id', $this->customer->id)
                    ->where('product_id', $productId)
                    ->exists()
            ) {
                session()->flash('message', 'Already added to Cart');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to Cart',
                    'type' => 'warning',
                    'status' => 409,
                ]);
                return false;
            } else {
                Cart::create([
                    'customer_id' => $this->customer->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'total' => $this->products->price,
                ]);
                // $this->emit('cartAddedUpdated');

                session()->flash('message', 'Cart Added Successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Cart Added Successfully',
                    'type' => 'success',
                    'status' => 200,
                ]);
            }
        } else {
            session()->flash('message', 'Please Login to continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to continue',
                'type' => 'info',
                'status' => 401,
            ]);
            return false;
        }
    }

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)
            ->where('customer_id', auth()->user()->customers->id)
            ->first();
        if ($cartData) {
            if ($cartData->quantity > 1) {
                $cartData->decrement('quantity');
                $cartData->update([
                    'total' => $cartData->quantity * $cartData->products->price,
                ]);
                // $this->emit('cartAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200,
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Should be At Least 1 Quantity',
                    'type' => 'success',
                    'status' => 200,
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404,
            ]);
        }
    }

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)
            ->where('customer_id', auth()->user()->customers->id)
            ->first();
        if ($cartData) {
            if ($cartData->products->quantity > $cartData->quantity) {
                $cartData->increment('quantity');
                $cartData->update([
                    'total' => $cartData->quantity * $cartData->products->price,
                ]);
                // $this->emit('cartAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200,
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' =>
                        'Only ' .
                        $cartData->products->quantity .
                        ' Quantity Available',
                    'type' => 'success',
                    'status' => 200,
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404,
            ]);
        }
    }

    public function removeCartItem(int $cartId)
    {
        $cartRemoveData = Cart::where(
            'customer_id',
            auth()->user()->customers->id
        )
            ->where('id', $cartId)
            ->first();
        if ($cartRemoveData) {
            $cartRemoveData->delete();
            // $this->emit('cartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Removed Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 500,
            ]);
        }
    }

    public function removeTheWholeCart()
    {
        $cartRemoveData = Cart::where(
            'customer_id',
            auth()->user()->customers->id
        )->delete();
        if ($cartRemoveData) {
            // $this->emit('cartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'The Whole Cart is Removed Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 500,
            ]);
        }
    }

    public function openDiv(bool $showDiv)
    {
        $this->showDiv = $showDiv;
    }

    public function checkInvoiceProductlist()
    {
        $this->invoiceProducts = Cart::where(
            'customer_id',
            auth()->user()->customers->id
        )->get();
        $this->emit('cartAddedUpdated');
    }

    public function render()
    {
        $data['customerInfo'] = auth()->user()->customers;
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['products'] = Products::get();
        $data['Cart'] = Cart::where(
            'customer_id',
            auth()->user()->customers->id
        )->get();
        $this->totalPrice = 0;
        foreach ($data['Cart'] as $cartItem) {
            $this->totalPrice += (int) $cartItem->total;
        }
        return view('livewire.product-checkout');
    }
}
