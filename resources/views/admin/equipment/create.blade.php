@extends('admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Add Equipment
                    <a href="{{ url('admin/equipments') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/equipments') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                 <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                    
                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection