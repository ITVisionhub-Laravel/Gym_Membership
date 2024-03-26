<x-admin> 
<div class="container py-3 ">
   <div class="card p-5">
     <h3 class="text-center mb-4">Payment Record Edit Form</h3>
     <form action="{{route('payment_records.update',$paymentrecord->id)}}" method="POST" >
        @csrf
        @method('PUT') 

        <div class="row">
            <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $paymentrecord->user->name }}" width="col-md-4" />
            <x-forms.dropdownfield :dropdownValues="$packages" name="package" width="col-md-12" checkOldValue="{{ $paymentrecord->package_id }}" value="{{$paymentrecord->package->name}}"
                labelName="Packages" width="col-md-4"></x-forms.dropdownfield>
            <x-forms.dropdownfield :dropdownValues="$payments" name="payment_type" width="col-md-12" checkOldValue="{{ $paymentrecord->provider_id }}" value="{{$paymentrecord->paymentprovider->name}}"
                labelName="Payment Methods" width="col-md-4"></x-forms.dropdownfield>
        </div>
        <div class="row">
            <x-forms.forminput name="image" type="file" placeholder="Image" value="{{$paymentrecord->bank_slip}}" width="col-md-4" />
            <x-forms.forminput name="price" placeholder="Price" value="{{ $paymentrecord->price }}" width="col-md-4" />
            <x-forms.forminput type="date" name="date" placeholder="date" value="{{$paymentrecord->record_date}}" width="col-md-4" />    
        </div>    
        {{-- 
            @error('package')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror--}}
        
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Update</button>
    </form>
   </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>