@extends('admin')

@section('content')
<div class="container my-3">
     @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <h3 class="my-2">Members List
    <a href="{{ url('admin/customers/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Members</a>
    </h3>
    <hr>
    <table id="myTable" class="display">
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
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->age }}</td>
                <td>{{ $customer->height}}</td>
                <td>{{ $customer->weight}}</td>
                <td>{{ $customer->address}}</td>
                <td>{{ $customer->phone_number}}</td>
                <td>{{ $customer->emergency_phone}}</td>
                <td>
                    <img src="{{asset('/uploads/customer/'.$customer->image)}}" style="width:50px;height:50px" alt="customer">
                </td>
                <td>
                    <a href="#"  class="btn-success btn-sm"><i class="fa-regular fa-eye"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/edit') }}"  class="btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script>
     $(document).ready( function () {
        // scrollX: true,
    } );
</script>
@endsection
   