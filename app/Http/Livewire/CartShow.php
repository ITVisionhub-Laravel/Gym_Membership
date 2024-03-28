<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Logo;
use App\Models\User;
use App\Models\Partner;
use Livewire\Component;
use App\Models\PaymentRecord;
use App\Models\CustomerQRCode;
use App\Models\DebitAndCredit;
use App\Models\PaymentPackage;
use App\Models\PaymentProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CartShow extends Component
{
    public $payment_provider_id, $packageInfo, $chooseOnePackage;

    protected $listeners = ['refreshComponent'];

    public function refreshComponent()
    {}
    protected $rules = [
        'payment_provider_id' => 'nullable|integer',
    ];

    public function mount()
    {
        $this->chooseOnePackage = Session::get('chosen_package_id');
    }

    public function choosePackage(PaymentPackage $package)
    {
        $this->chooseOnePackage = $package->id;
        $this->packageInfo = $package;

        Session::put('chosen_package_id', $package->id);
    }

    public function checkout()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $this->storePayment();
            $this->debitCreditInfos();
            DB::commit();
            $this->emit('checkoutSuccess');
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            $this->emit('checkoutFailed', 'Checkout failed. Please try again later.');
        }
    }

    public function storePayment()
    {
        $gymfee_payment_record = new PaymentRecord();

        $gymfee_payment_record->payment_provider_id = $this->payment_provider_id;
        $gymfee_payment_record->payment_package_id = $this->packageInfo->id;
        $gymfee_payment_record->record_date = now()->format('Y.m.d');
        $gymfee_payment_record->payment_screenshot = '';
        $gymfee_payment_record->user_id = auth()->id();
        if ($gymfee_payment_record->save()) {
            $this->emit('paymentStored', 'Payment stored successfully.');
        } else {
            $this->emit('paymentStoreFailed', 'Failed to store payment.');
        }
    }

    public function debitCreditInfos()
    {
        $user = Auth::user();
        $name = "Registering with " . $this->packageInfo->package . " package and " . $this->packageInfo->promotion . "%";
        $new_debit_credit_info = new DebitAndCredit();
        $new_debit_credit_info->name = $name;
        $new_debit_credit_info->amount = $this->packageInfo->promotion_price;
        $new_debit_credit_info->status_id = Config::get('variables.FAILURE');
        $new_debit_credit_info->date = Carbon::now()->format('Y-m-d');
        $new_debit_credit_info->related_info_id = $user->member_card;
        $new_debit_credit_info->related_info_type = "member";
        $new_debit_credit_info->transaction_type_id = 1;
        if ($new_debit_credit_info->save()) {
            $this->emit('debitCreditInfoStored', 'Debit/Credit info stored successfully.');
        } else {
            $this->emit('debitCreditInfoStoreFailed', 'Failed to store Debit/Credit info.');
        }
    }

    public function render()
    {
        Session::forget('chosen_package_id');
        // ->whereNotNull('member_card')
        $data['customerInfo'] = User::where('id', auth()->user()->id)->first();
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $data['packages'] = PaymentPackage::get();
        $data['providers'] = PaymentProvider::get();
        $data['debitCreditInfo'] = DebitAndCredit::where('related_info_id', auth()->user()->member_card)->first();

        if ($data['customerInfo']) {
            $data['qrcode'] = CustomerQRCode::where(
                'user_id',
                $data['customerInfo']->id
            )->first();
        }
        return view('livewire.cart-show', ['data' => $data]);
    }
}
