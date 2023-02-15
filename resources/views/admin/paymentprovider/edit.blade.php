<x-admin>
<div class="container py-3 ">
  <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Payment Type Edit Form</h3>
     </div>
     <div class="card-body">
     <form action="{{route('payment_providers.update', $paymentprovider->id)}}" method="POST" >
        @csrf
        @method('put')
        <x-forms.forminput name="name" labelName="Payment Type Name" value="{{$paymentprovider->name}}" placeholder="Enter Type Name" width="col-md-12" />
        
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Update</button>
    </form>
    </div>
   </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>