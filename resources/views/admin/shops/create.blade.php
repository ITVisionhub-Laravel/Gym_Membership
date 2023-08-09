<x-admin>

   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Shop Create Form</h3>
     </div>
     <div class="card-body">
        <form action="{{ url('admin/shopkeepers') }}" method="POST"  enctype="multipart/form-data">
        @csrf

            <x-forms.dropdownfield :dropdownValues="$products" name="product_id" labelName="Products" width="col-md-12"></x-forms.dropdownfield>
            <x-forms.dropdownfield :dropdownValues="$shopTypes" name="shop_type_id" labelName="Shop Types" width="col-md-12"></x-forms.dropdownfield>
            <x-forms.forminput wireClick=true wireFunction="checkExtraQuantity" wireValue=true name="quantity" type="number" placeholder="Enter quantity" width="col-md-12" />
           
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>   
    </form>
     </div>
   </div>

<x-slot name="scripts">
</x-slot>
</x-admin>