<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Edit Logo
                    <a href="{{url('admin/logo/')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                </h3>
            </div>
            <div class="card-body">
            <form action="{{url('admin/logo/'.$logo->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                        <div class="row pt-2">
                            <x-forms.forminput name="name" placeholder="Enter Name"  value="{{ $logo->name }}" width="col-md-6" />
                            <x-forms.forminput type="file" name="image"  value="{{$logo->image}}" width="col-md-12" placeholder="Image" width="col-md-6" />
                        </div>
                        <div class="row">
                            <x-forms.forminput name="description" value="{{$logo->description}}" type="textarea" width="col-md-12" />
                        </div>
                        <div class="row">
                            <x-forms.forminput name="location" value="{{$logo->location}}" placeholder="Location" width="col-md-6" />
                            <x-forms.forminput name="ph_no" value="{{$logo->ph_no}}" placeholder="Enter Phone Number" width="col-md-6" />
                        </div>
                        <div class="row">
                            <x-forms.forminput name="email" value="{{$logo->email}}" placeholder="Enter Email" width="col-md-6" />

                            <x-forms.forminput name="open_day" value="{{$logo->open_day}}" placeholder="Enter Phone Number" width="col-md-6" />
                            
                        </div>
                        <div class="row">
                            <x-forms.forminput name="open_time" value="{{$logo->open_time}}" placeholder="Enter Phone Number" width="col-md-6" />
                            <x-forms.forminput name="close_day" value="{{$logo->close_day}}" placeholder="Enter Phone Number" width="col-md-6" />
                        </div>
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
<x-slot name="scripts">
</x-slot>
</x-admin>