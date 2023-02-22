<?php

namespace App\Http\Livewire;

use App\Models\PaymentExpiredMembers as ModelsPaymentExpiredMembers;
use Livewire\Component;
use App\Models\PaymentRecord;
use App\Models\PaymentPackage;
use App\Models\PaymentProvider;

class PaymentExpiredMembers extends Component
{
    public $memberId,
        $packages,
        $providers,
        $package,
        $provider,
        $promotion,
        $originalPrice,
        $price,
        $payment_expired_members,
        $payment_records;

    public function mount()
    {
        $this->payment_expired_members = ModelsPaymentExpiredMembers::get();
        $this->providers = PaymentProvider::get();
        $this->packages = PaymentPackage::get();
    }

    public function rules()
    {
        return [
            'package' => 'required|string',
            'provider' => 'required|string',
            'promotion' => 'required|integer',
            'originalPrice' => 'required|integer',
            'price' => 'required|integer',
        ];
    }

    public function resetInput()
    {
        $this->package = null;
        $this->provider = null;
        $this->promotion = null;
        $this->originalPrice = null;
        $this->price = null;
    }

    public function closeModal()
    {
        @dd('hello');
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function addPayments(int $customer_id)
    {
        $this->memberId = $customer_id;
    }
    public function storePayment()
    {
        @dd('hello');
        $this->payment_records = PaymentRecord::where(
            'customer_id',
            $this->memberId
        )->first();
        $this->provider = $this->payment_records->paymentprovider->id;
        $this->package = $this->payment_records->package->id;
        $this->promotion = $this->payment_records->package->promotion;
        $this->originalPrice = $this->payment_records->package->original_price;
        $this->price = $this->payment_records->price;
    }

    public function render()
    {
        return view('livewire.payment-expired-members');
    }
}
