@extends('admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Members List
                    <a href="{{ url('admin/members/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Members</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Emergency Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                            <td>{{ $member->id }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->age }}</td>
                            <td>{{ $member->height}}</td>
                            <td>{{ $member->weight}}</td>
                            <td>{{ $member->address}}</td>
                            <td>{{ $member->phone_number}}</td>
                            <td>{{ $member->emergency_phone}}</td>
                            <td>
                                <a href="{{ url('admin/members/'.$member->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('admin/members/'.$member->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a>
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