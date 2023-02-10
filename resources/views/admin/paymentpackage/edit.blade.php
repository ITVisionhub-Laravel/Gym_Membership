<x-admin>
<div class="container py-3 ">
   <div class="card p-5">
     <h3 class="text-center my-2">Package Edit Form</h3>
     <form action="{{route('payment_packages.update', $paymentpackage->id)}}" method="POST" >
        @csrf
        @method('put')
            <x-forms.forminput name="package" value="{{$paymentpackage->package}}" placeholder="Enter Package" width="col-md-12" />
            <x-forms.forminput name="promotion" value="{{$paymentpackage->promotion}}" placeholder="Enter Promotion" width="col-md-12" />
            <x-forms.forminput name="original_price" labelName="original price" value="{{$paymentpackage->original_price}}" placeholder="Enter Promotion" width="col-md-12" />
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Update</button>
    </form>
   </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>