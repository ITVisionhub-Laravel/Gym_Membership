<x-admin>
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
                <th>Record_date</th>
                <th>Payment Method</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($paymentrecords as $paymentrecord)
            <tr>
                <td>{{$j++}}</td>
                <td>{{$paymentrecord->member->name}}</td>
                <td>{{$paymentrecord->package->package}}</td>
                <td>{{$paymentrecord->price}}</td>
                <td>{{$paymentrecord->record_date}}</td>
                <td>{{$paymentrecord->paymentprovider->name}}</td>
                
                {{-- <td>
                    <a href="{{route('payment_records.edit', $paymentrecord->id)}}" class="btn btn-info py-2">Edit</a>

                    <form action="{{route('payment_records.destroy',$paymentrecord->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger py-2">Delete</button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
           
        </tbody>
    </table>
</div>
<x-slot name="scripts">
<script>
     $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
</x-slot>
</x-admin>
   