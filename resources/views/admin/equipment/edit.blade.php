@extends('admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Edit Equipment
                    <a href="{{ url('admin/equipments') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/equipments/'.$equipment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                       @method('PUT')
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$equipment->name}}" class="form-control">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                 <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{asset('/uploads/equipment/'.$equipment->image)}}" width="60px" height="60px" alt="">
                   
                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection