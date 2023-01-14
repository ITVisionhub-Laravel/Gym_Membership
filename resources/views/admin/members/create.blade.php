@extends('admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Add Member
                    <a href="{{ url('admin/members') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/members') }}" method="POST">
                    @csrf
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="">Age</label>
                    <input type="number" name="age" class="form-control">
                    @error('age')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="">Height</label>
                    <input type="text" name="height" class="form-control">
                    @error('height')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="">Weight</label>
                    <input type="text" name="weight" class="form-control">
                    @error('weight')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <input type="text" name="address" class="form-control">
                    @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="">Mobile</label>
                    <input type="text" name="phone_number" class="form-control">
                    @error('phone_number')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="">Emergency Mobile</label>
                    <input type="text" name="emergency_phone" class="form-control">
                    @error('emergency_phone')<small class="text-danger">{{ $message }}</small>@enderror
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