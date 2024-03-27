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
use Illuminate\Support\Facades\Session;

class CartShow extends Component
{
    public $payment, $new_debit_credit_info, $provider_id, $packageInfo, $chooseOnePackage, $userChoosePackage;

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

    public function checkout()
    { 
        // $this->package = $package;
        
        DB::beginTransaction();
        try{
            $this->storePayment(); 
            $this->debitCreditInfos();
            // $this->storeCustomerQR();
            // Commit the transaction if all operations succeed
            DB::commit();
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback(); 
        }
       
    }

    public function storePayment()
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

        $gymfee_payment_record->package_id = $this->packageInfo->id;
        $gymfee_payment_record->price = $this->packageInfo->promotion_price;
        $gymfee_payment_record->record_date = date('Y.m.d');
        $gymfee_payment_record->bank_slip = '';
        $gymfee_payment_record->user_id = auth()->user()->id;

        try {
            if ($gymfee_payment_record->save()) {
                $this->payment = $gymfee_payment_record;
            }
        } catch (Exception $e) {
            dd("Exception occurred: " . $e->getMessage());
        }
    }


    public function debitCreditInfos(){
        $user = Auth::user();
        // $newDebitCreditInfo = $user->debitCreditInfo->create([
        //     "name" => "test1",
        //     "amount" => "1200",
        //     "status" => false,
        //     "transaction_type_id" => 1
        // ]); 
        $name = "Registering with ".$this->payment->package->package." package and ". $this->payment->package->promotion."%";
        $new_debit_credit_info = new DebitAndCredit();
        $new_debit_credit_info->name = $name;
        $new_debit_credit_info->amount = $this->payment->price;
        $new_debit_credit_info->status = "failure";
        $new_debit_credit_info->date = Carbon::now()->format('Y-m-d');
        $new_debit_credit_info->related_info_id = $user->member_card;
        $new_debit_credit_info->related_info_type = "member";
        $new_debit_credit_info->transaction_type_id = 1;
        try {
            if ($new_debit_credit_info->save()) {
                $this->new_debit_credit_info = $new_debit_credit_info;
            }
        } catch (Exception $e) {
            dd("Exception occurred: " . $e->getMessage());
        } 
    }


    // public function storeCustomerQR()
    // {
    //     $customerQRCode = new CustomerQRCode();
    //     $customerQRCode->member_card_id = auth()->user()->member_card;
    //     $customerQRCode->user_id = auth()->user()->id;

    //     if ($customerQRCode->save()) {
    //         $this->dispatchBrowserEvent('message', [
    //             'text' => 'Pay GymFee Successfully',
    //             'type' => 'success',
    //             'status' => 200,
    //         ]);
    //     } else {
    //         $this->dispatchBrowserEvent('message', [
    //             'text' => 'Fail GymFee Payment',
    //             'type' => 'error',
    //             'status' => 404,
    //         ]);
    //     }
    // }

    public function render()
    {
        $data['customerInfo'] = User::where('id', auth()->user()->id)->whereNotNull('member_card')->first();
        // $data['paymentExpired'] = PaymentExpire
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
