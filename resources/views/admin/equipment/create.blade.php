<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h3>Add Equipment
                    <a href="{{ url('admin/equipments') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/equipments') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-forms.forminput name="name" placeholder="Enter Your Name" width="col-md-12"/>
                    <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-12"/>
                
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