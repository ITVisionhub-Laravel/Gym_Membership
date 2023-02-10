@extends('admin')

@section('content')

<div class="container py-3 ">
   <div class="card p-5">
     <h3 class="text-center my-2">Payment Record Create Form</h3>
     <form action="{{route('payment_records.store')}}" method="POST" >
        @csrf
        <x-forms.dropdownfield :dropdownValues="$members" name="member_name" width="col-md-12"  labelName="Members Name"></x-forms.dropdownfield>
        
        <x-forms.dropdownfield :dropdownValues="$packages" name="package" width="col-md-3" width="col-md-12"  labelName="Packages"></x-forms.dropdownfield>

        <x-forms.forminput name="price" type="number" id="price" placeholder="Price" width="col-md-12" required readonly/>     

        <x-forms.forminput name="record_date" type="date"  placeholder="Price" labelName="Date" width="col-md-12" required readonly/>     

        <x-forms.dropdownfield :dropdownValues="$payments" name="payment_record" width="col-md-3" width="col-md-12" labelName="Payment Methods"></x-forms.dropdownfield>

        
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>
    </form>
   </div>
</div>

@endsection