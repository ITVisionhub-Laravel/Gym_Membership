<x-admin>

   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Products Create Form</h3>
     </div>
     <div class="card-body">
        <form action="{{ url('admin/products') }}" method="POST"  enctype="multipart/form-data">
        @csrf

           
                <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-12" />
                <x-forms.forminput name="price" placeholder="Enter Price" width="col-md-12" />
                <x-forms.forminput name="quantity" placeholder="Enter Quantity" labelName="quantity" width="col-md-12" />
                <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-12" />
                    
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>   
    </form>
     </div>
   </div>

<x-slot name="scripts">
</x-slot>
</x-admin>