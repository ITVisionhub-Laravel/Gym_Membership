@extends('admin')

@section('content')
<div class="container my-3">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    <h3 class="my-2">Payment Record List</h3>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Member Name</th>
                <th>Package</th>
                <th>Price</th>
                <th>Date</th>
                <th>Payment Method</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($paymentrecords as $paymentrecord)
            <tr>
                <td>{{$j++}}</td>
                <td>{{$paymentrecord->customer->name}}</td>
                <td>{{$paymentrecord->package->package}}</td>
                <td>{{$paymentrecord->price}}</td>
                <td>{{$paymentrecord->date}}</td>
                <td>{{$paymentrecord->paymentprovider->name}}</td>
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
   