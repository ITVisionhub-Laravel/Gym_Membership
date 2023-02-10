<x-admin>
<div class="container py-3 ">
   <div class="card p-5">
     <h3 class="text-center my-2">Package Create Form</h3>
     <form action="{{route('payment_packages.store')}}" method="POST" >
        @csrf
            <x-forms.forminput name="package" placeholder="Enter Package" width="col-md-12" />
            <x-forms.forminput name="promotion" placeholder="Enter Promotion" width="col-md-12" />
            <x-forms.forminput name="original_price" placeholder="Enter Original Price" labelName="Original price" width="col-md-12" />
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>   
    </form>
   </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>