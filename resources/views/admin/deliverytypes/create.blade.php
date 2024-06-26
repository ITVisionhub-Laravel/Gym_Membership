<x-admin>

   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">DeliveryType Create Form</h3>
     </div>
     <div class="card-body">
        <form action="{{ url('admin/deliverytypes') }}" method="POST"  enctype="multipart/form-data">
        @csrf
            <div class="row">
                <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-6" />
                 <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-6" />
                
            </div>
            
            <div class="row">
                <x-forms.forminput name="kg" placeholder="Enter kg" labelName="kg" width="col-md-6" />
                 <x-forms.dropdownfield :dropdownValues="$townships" placeholder="Enter TownshipName" name="township_id" labelName="township_name" width="col-md-6"></x-forms.dropdownfield>
               </div>

            <div class="row">
                <x-forms.forminput name="cost" labelName="cost" placeholder="Enter cost" width="col-md-6" />
               <x-forms.forminput name="waiting-time" placeholder="Enter waiting-time" width="col-md-6" />
            </div> 
            
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>   
    </form>
     </div>
   </div>

<x-slot name="scripts">
</x-slot>
</x-admin>