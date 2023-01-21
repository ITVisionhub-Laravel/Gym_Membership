@extends('admin')
@section('content')



<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Tainer List
                    <a href="{{ url('admin/trainers/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Trainer</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainers as $trainer)
                            <tr>
                            <td>{{ $trainer->id }}</td>
                            <td>{{ $trainer->name }}</td>
                            <td>{{ $trainer->description }}</td>
                            <td>
                                <img src="{{asset('/uploads/trainer/'.$trainer->image)}}" style="width:70px;height:70px" alt="">
                             
                            </td>
                            
                            <td>
                                <a href="{{ url('admin/trainers/'.$trainer->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('admin/trainers/'.$trainer->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection