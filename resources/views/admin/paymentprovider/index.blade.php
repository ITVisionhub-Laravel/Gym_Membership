@extends('admin')

@section('content')
<div class="container my-3">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    <h3 class="my-2">Payment Type List</h3>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Payment Type Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($paymentproviders as $paymentprovider)
            <tr>
                <td>{{$j++}}</td>
                <td>{{$paymentprovider->name}}</td>
                
                <td>
                    <a href="{{route('payment_providers.edit', $paymentprovider->id)}}" class="btn btn-info py-2">Edit</a>

                    <form action="{{route('payment_providers.destroy',$paymentprovider->id)}}" method="POST" class="d-inline">
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
@section('scripts')
<script>
     $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endsection
   