<?php

namespace App\Http\Resources;

use App\Models\Address;
use App\Models\PaymentPackage;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    private $records;
    private $logos;
    public function __construct($records, $logo)
    {
        $this->records = $records;
        $this->logos = $logo;
    }

    public function toArray($request)
    {
        $userData = User::findOrFail($this->records->user_id);
        $addressData = Address::where('user_id', $this->records->user_id)->get();
        $paymentPackageData = PaymentPackage::findOrFail($this->records->payment_package_id);

        return [
            'Member Name' => $userData->name,
            'Phone Number' => $userData->phone_number,
            'Member ID Number' => $userData->member_card,

            'Package' => $paymentPackageData->package,
            'Promotion' => $paymentPackageData->promotion . '%',
            'Paid On' => $paymentPackageData->created_at->format("F j, Y, g:i a"),
            'Original Fee' => $paymentPackageData->original_price,
            'Discounted Fee' => $paymentPackageData->promotion_price,

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
            'api_url' => url('http://127.0.0.1:8000/api/admin/customers/11/invoice'),
            'message' => 'Your action is successful'
        ];
    }
}
