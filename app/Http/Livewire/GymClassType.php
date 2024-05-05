<?php

namespace App\Http\Livewire;

use App\Models\Logo;
use App\Models\User;
use App\Models\Partner;
use Livewire\Component;
use App\Models\GymClass;
use Illuminate\Http\Request;
use App\Http\Resources\GymClassResource;
use App\Http\Resources\GymClassByCategoryResource;

class GymClassType extends Component
{
    public $gymClassCategoryId;

    public function mount($gymClassCategoryId)
    {
        $this->gymClassCategoryId = $gymClassCategoryId;
    }

    public function gymClassType(Request $request){
        $this->gymClassCategoryId = $request->route('gymClassCategoryId');
        $gymClasses = GymClass::where('gym_class_category_id', $this->gymClassCategoryId)->get();
        foreach($gymClasses as $gymClass){
            $gymClass->trainers;
            $gymClass->schedules;
        }
        // $gymClass->trainers['0']
        return GymClassByCategoryResource::collection($gymClasses);
    }

    public function render()
    { 
        $gymClasses = GymClass::where('gym_class_category_id', $this->gymClassCategoryId)->get();

        $data['customerInfo'] = User::where('id', auth()->user()->id)->whereNotNull('member_card')->first();
        $data['logo'] = Logo::first();
        $data['partner'] = Partner::get();
        $gymClassType = $gymClasses->first()?->classCategory->name; 
        return view('livewire.gym-class-type', ['data' => $data, 'gymClasses' => $gymClasses, 'gymClassType' => $gymClassType]);
    }
}
