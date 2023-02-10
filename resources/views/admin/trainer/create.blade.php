@extends('admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Add Trainer
                    <a href="{{ url('admin/trainers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/trainers') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-12" />
                    <x-forms.forminput name="description" type="textarea" width="col-md-12" />
                    <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-12" />
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection