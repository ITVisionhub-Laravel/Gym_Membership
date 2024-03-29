<?php

namespace App\Http\Livewire;

use App\Models\Logo;
use App\Models\User;
use App\Models\Partner;
use Livewire\Component;
use App\Models\GymClass;

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
        $gymClassType = $gymClasses->first()->category->name;
        $data['customerInfo'] = User::where('id', auth()->user()->id)->whereNotNull('member_card')->first();
        // $data['paymentExpired'] = PaymentExpire
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        return view('livewire.gym-class-type',['data' => $data, 'gymClasses' => $gymClasses, 'gymClassType' => $gymClassType]);
    }
}
