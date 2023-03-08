<x-admin>
<div class="container my-3">
     <x-successmessage/>
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
   