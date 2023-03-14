<x-admin>

   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Brands Create Form</h3>
     </div>
     <div class="card-body">
        <form action="{{ url('admin/brands') }}" method="POST"  enctype="multipart/form-data">
        @csrf

            <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-12" />
            <x-forms.forminput name="slug" placeholder="Enter slug" width="col-md-12" />
            <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button> 

        </form>
     </div>
   </div>

<x-slot name="scripts">
</x-slot>
</x-admin>