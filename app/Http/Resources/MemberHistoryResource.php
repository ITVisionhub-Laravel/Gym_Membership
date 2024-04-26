<?php

namespace App\Http\Resources;

use App\Models\Address;
use App\Models\PaymentPackage;
use App\Models\Street;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    private $logos;
    private $records;
    private $packages;
    private $totalAmount;

    public function __construct($logos, $records, $packages, $totalAmount)
    {
        $this->logos = $logos;
        $this->records  = $records;
        $this->packages = $packages;
        $this->totalAmount = $totalAmount;
    }

    public function toArray($request)
    {
        $userID = $this->records->pluck('user_id');
        $userData = User::findOrFail($userID);
        $addressData = Address::where('user_id', $userID)->get();

        return [
            'Member Name' => $userData->last()->name,
            'Phone Number' => $userData->last()->phone_number,
            'Member ID Number' => $userData->last()->member_card,
            'Cost Fees' => $this->records->map(function ($recordData) {
                $paymentPackageData = PaymentPackage::findOrFail($recordData->payment_package_id);
                return [
                    'Package' => $paymentPackageData->package,
                    'Promotion' => $paymentPackageData->promotion . '%',
                    'Paid On' => $paymentPackageData->created_at->format("F j, Y, g:i a"),
                    'Original Fee' => $paymentPackageData->original_price,
                    'Discounted Fee' => $paymentPackageData->promotion_price,
                    'Tatal Fee' => $this->totalAmount
                ];
            }),
            'address' => $addressData->map(function ($address) {
                return [
                    'block_no' => $address->block_no,
                    'floor' => $address->floor,
                    'street' => $address->street->name,
                    'ward' => $address->street->ward->name,
                    'township' => $address->street->ward->township->name,
                    'city' => $address->street->ward->township->city->name,
                    'zipcode' => $address->zipcode
                ];
            }),
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/admin/customers/5/history'),
            'message' => 'Your action is successful'
        ];
    }
}
