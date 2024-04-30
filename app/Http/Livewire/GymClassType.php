<?php

namespace App\Http\Livewire;

use App\Models\Logo;
use App\Models\User;
use App\Models\Partner;
use Livewire\Component;
use App\Models\GymClass;
use App\Http\Resources\DashboardResource;

class GymClassType extends Component
{
    public $gymClassCategoryId;

    public function mount($gymClassCategoryId)
    {
        $this->gymClassCategoryId = $gymClassCategoryId;
    }

    public function render()
    { 
        $gymClasses = GymClass::where('gym_class_category_id', $this->gymClassCategoryId)->get();
        $gymClassType = $gymClasses->first()->classCategory->name;
        // auth()->user()->id
        $data['customerInfo'] = User::where('id', 3)->whereNotNull('member_card')->first();
        // $data['paymentExpired'] = PaymentExpire
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        if (request()->expectsJson()) {
            return new DashboardResource($data);
        }else{

            return view('livewire.gym-class-type',['data' => $data, 'gymClasses' => $gymClasses, 'gymClassType' => $gymClassType]);
        }
    }
}
