<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Edit Trainer
                    <a href="{{ url('admin/trainers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/trainers/'.$trainer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-forms.forminput name="name" placeholder="Enter Your Name" value="{{ $trainer->name }}" width="col-md-12"/>
                    <x-forms.forminput name="description" type="textarea" value="{{$trainer->description}}" width="col-md-12" />
                    <x-forms.forminput name="image" type="file" placeholder="Image" value="{{'/uploads/trainer/'.$trainer->image}}" width="col-md-12"/>

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