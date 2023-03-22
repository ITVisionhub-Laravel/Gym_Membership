<x-admin>

   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">ShopType Create Form</h3>
     </div>
     <div class="card-body">
        <form action="{{ url('admin/shoptypes') }}" method="POST"  enctype="multipart/form-data">
        @csrf
            <div class="row">
                <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-6" />
                <x-forms.forminput name="email" placeholder="Enter Email" width="col-md-6" />
            </div>
            
            <div class="row">
                <x-forms.forminput name="address" placeholder="Enter Address" labelName="address" width="col-md-6" />
                <x-forms.forminput name="phone" placeholder="Enter Phone" labelName="phone" width="col-md-6" />
               </div>

            <div class="row">
                <x-forms.forminput name="hot_line" labelName="hot_line" placeholder="Enter hot_line" width="col-md-6" />
                <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-6" />
            </div> 
            
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>   
    </form>
     </div>
   </div>

<x-slot name="scripts">
</x-slot>
</x-admin>