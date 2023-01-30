@extends('admin')

@section('content')
<div class="container my-3">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    <h3 class="my-2">Attendent List</h3>
    <form action="{{route('attendents.store')}}" method="post" class="my-3">
        @csrf
        <input type="text" name="member" class="form-control w-25" style="display: inline-block;" placeholder="Enter member ID">
        <button type="submit" class="btn btn-outline-success">Check-in</button>
    </form>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Attendent Date</th>
                <th>Member Name</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($attendents as $attendent)
            <tr>

                <td>{{$j++}}</td>
                <td>{{$attendent->attendent_date}}</td>
                <td>{{$attendent->member->name}}</td>
                <td>{{$attendent->member->phone_number}}</td>
                <td>
                    <form action="{{route('attendents.destroy',$attendent->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger py-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
           
        </tbody>
    </table>
</div>
@endsection
@section('script')
<script>
     $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endsection
   