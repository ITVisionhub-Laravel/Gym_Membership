<x-admin>
<div class="row">
            <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
                <div class="card w-50 mx-auto">
                    <div class="card-header">
                        <h3>Add Logo
                            <a href="{{url('admin/logo')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/logo')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row pt-2">
                                <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-6" />
                                <x-forms.forminput type="file" name="image" placeholder="Image" width="col-md-6" />
                            </div>
                            <div class="row">
                                <x-forms.forminput name="description" type="textarea" width="col-md-6" />
                                <x-forms.forminput name="location" placeholder="Location" width="col-md-6" />
                            </div>
                            <div class="row">
                                <x-forms.forminput name="address" placeholder="Address" width="col-md-6" />
                                <x-forms.forminput name="ph_no" placeholder="Enter Phone Number" width="col-md-6" />
                            </div>
                            <div class="row">
                                <x-forms.forminput name="email" placeholder="Enter Email" width="col-md-6" />
                                <x-forms.forminput name="open_day" placeholder="Enter Phone Number" width="col-md-6" />
                                
                            </div>
                            <div class="row">
                                <x-forms.forminput name="open_time" placeholder="Enter Phone Number" width="col-md-6" />
                                <x-forms.forminput name="close_day" placeholder="Enter Phone Number" width="col-md-6" />
                            </div>
                            
                             <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                             </div> 
                        </form>
                    </div>
                </div>
            </div>
    </div>
<x-slot name="scripts">
</x-slot>
</x-admin>