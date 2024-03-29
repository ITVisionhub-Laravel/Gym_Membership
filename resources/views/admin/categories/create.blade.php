<x-admin>

   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Category Create Form</h3>
     </div>
     <div class="card-body">
        <form action="{{ url('admin/categories') }}" method="POST"  enctype="multipart/form-data">
        @csrf

            <div class="row">
                <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-6" />
                <x-forms.forminput name="slug" placeholder="Enter Slug" width="col-md-6" />
            </div>

            <div class="row">
                <x-forms.forminput name="small_description" labelName="small description" type="textarea" width="col-md-6" />
                <x-forms.forminput name="description" type="textarea" width="col-md-6" />
            </div>

            <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-12" />

        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>
    </form>
     </div>
   </div>

<x-slot name="scripts">
</x-slot>
</x-admin>
