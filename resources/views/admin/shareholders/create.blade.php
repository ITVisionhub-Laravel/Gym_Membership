<x-admin>

   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Products Create Form</h3>
     </div>
     <div class="card-body">
        <form action="#" method="POST"  enctype="multipart/form-data">
        @csrf
{{--
        <div class="row">
          <x-forms.dropdownfield :dropdownValues="$categories" name="category_id" labelName=" Category" width="col-md-6"></x-forms.dropdownfield>
         <x-forms.dropdownfield :dropdownValues="$brands" name="brand_id" labelName=" Brand" width="col-md-6"></x-forms.dropdownfield>
        </div>

            <div class="row">
                <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-6" />
                <x-forms.forminput name="slug" placeholder="Enter Slug" width="col-md-6" />
            </div>
            <div class="row">
                <x-forms.forminput name="small_description" type="textarea" placeholder="Enter small_description" width="col-md-6" />
                <x-forms.forminput name="description" type="textarea" placeholder="Enter description" width="col-md-6" />
            </div>
            <div class="row">
                <x-forms.forminput name="buying_price" placeholder="Enter buying_price" width="col-md-6" />
                <x-forms.forminput name="selling_price" placeholder="Enter selling_price" width="col-md-6" />
            </div>
            <div class="row">
                <x-forms.forminput name="quantity" placeholder="Enter quantity" width="col-md-6" />
                <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-6" />
            </div> --}}


        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>
    </form>
     </div>
   </div>

<x-slot name="scripts">
</x-slot>
</x-admin>
