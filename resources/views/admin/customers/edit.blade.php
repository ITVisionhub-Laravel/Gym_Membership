@extends('admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Edit Member
                    <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/customers/'.$customer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Age</label>
                    <input type="number" name="age" value="{{ $customer->age }}" class="form-control">
                    @error('age')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Height</label>
                    <input type="text" name="height" value="{{ $customer->height }}" class="form-control">
                    @error('height')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Weight</label>
                    <input type="text" name="weight" value="{{ $customer->weight }}" class="form-control">
                    @error('weight')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Address</label>
                    <input type="text" name="address" value="{{ $customer->address }}" class="form-control">
                    @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Mobile</label>
                    <input type="text" name="phone_number" value="{{ $customer->phone_number }}" class="form-control">
                    @error('phone_number')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Emergency Mobile</label>
                    <input type="text" name="emergency_phone" value="{{ $customer->emergency_phone }}" class="form-control">
                    @error('emergency_phone')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{asset('/uploads/customer/'.$customer->image)}}" width="50px" height="50px" alt="">
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