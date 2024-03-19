<?php

namespace App\Http\Livewire;

use App\Models\Logo;
use App\Models\Partner;
use Livewire\Component;
use App\Models\PaymentRecord;
use App\Models\CustomerQRCode;
use App\Models\PaymentPackage;
use App\Models\PaymentProvider;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CartShow extends Component
{
    public $provider_id, $packageInfo, $chooseOnePackage, $userChoosePackage;

    public function mount()
    {
        $chosenPackageId = Session::get('chosen_package_id');
        if ($chosenPackageId) {
            $this->chooseOnePackage = $chosenPackageId;
        }
    }

    public function rules()
    {
        return [
            'provider_id' => 'nullable|integer',
        ];
    }

    public function resetInput()
    {
        $this->provider_id = null;
    }

    public function choosePackage(PaymentPackage $package)
    {
        $this->chooseOnePackage = $package->id;
        $this->packageInfo = $package;

        Session::put('chosen_package_id', $package->id);
    }

    public function checkout(PaymentPackage $package)
    {
        $validatedData = $this->validate([
            'provider_id' => 'nullable',
        ]);
        $gymfee_payment_record = new PaymentRecord();
        if ($validatedData['provider_id'] == null) {
            $gymfee_payment_record->provider_id = '0';
        } else {
            $gymfee_payment_record->provider_id = $validatedData['provider_id'];
        }

        $gymfee_payment_record->package_id = $package->id;
        $gymfee_payment_record->price = $package->promotion_price;
        $gymfee_payment_record->record_date = date('Y.m.d');
        $gymfee_payment_record->bank_slip = '';
        $gymfee_payment_record->user_id = auth()->user()->id;

        if ($gymfee_payment_record->save()) {
            $customerQRCode = new CustomerQRCode();
            $customerQRCode->member_card_id = auth()->user()->member_card;
            $customerQRCode->user_id = auth()->user()->id;

            if ($customerQRCode->save()) {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Pay GymFee Successfully',
                    'type' => 'success',
                    'status' => 200,
                ]);
            } else {
                $gymfee_payment_record->delete();
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Fail GymFee Payment',
                    'type' => 'error',
                    'status' => 404,
                ]);
            }
        }
    }

    public function render()
    {
        $data['customerInfo'] = User::where('id', auth()->user()->id)->whereNotNull('member_card')->first();
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();

        if ($data['customerInfo']) {
            $data['qrcode'] = CustomerQRCode::where(
                'user_id',
                $data['customerInfo']->id
            )->first();
        }
        return view('livewire.cart-show', ['data' => $data]);
    }
}
