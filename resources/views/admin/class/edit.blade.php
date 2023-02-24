<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h3>Edit Class
                    <a href="{{ url('admin/class') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/class/'.$class->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $class->name }}" width="col-md-6" />
                        <x-forms.dropdownfield :dropdownValues="$trainers" checkOldValue="{{ $class->trainer->id }}" name="trainer_id" labelName="Trainer Name"  width="col-md-6"></x-forms.dropdownfield>
                    </div>
                    <div class="row">
                        <x-forms.forminput name="image" type="file" placeholder="Image" value="{{$class->image}}" width="col-md-6" />
                        <x-forms.forminput name="day" placeholder="Day" value="{{$class->day}}" width="col-md-6" />
                    </div>
                    <div class="row">
                        <x-forms.forminput name="morning_time" value="{{$class->morning_time}}" placeholder="Morning_time" width="col-md-6" />
                        <x-forms.forminput name="evening_time" value="{{$class->evening_time}}" placeholder="Evening_time" width="col-md-6" />
                    </div>
                    
                    <x-forms.forminput name="description" type="textarea" value="{{$class->description}}" width="col-md-12" />
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