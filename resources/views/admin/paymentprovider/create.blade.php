<x-admin>

   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Payment Create Form</h3>
     </div>
     <div class="card-body">
     <form action="{{route('payment_providers.store')}}" method="POST" >
        @csrf
        <x-forms.forminput name="name" labelName="Payment Type Name" placeholder="Enter Type Name" width="col-md-12" />
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>
    </form>
    </div>
   </div>

<x-slot name="scripts">
</x-slot>
</x-admin>