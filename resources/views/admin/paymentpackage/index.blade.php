<x-admin>
<div class="container my-3">
     <x-successmessage/>
    <h3 class="my-2">Package Lists</h3>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Package</th>
                <th>Promotion (%)</th>
                <th>Original Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($paymentpackages as $paymentpackage)
            <tr>
                <td>{{$j++}}</td>
                <td>{{$paymentpackage->package}}</td>
                <td>{{$paymentpackage->promotion}}%</td>
                <td>{{$paymentpackage->original_price}}</td>
                <td>
                    <a href="{{route('payment_packages.edit', $paymentpackage->id)}}" class="btn btn-info py-2">Edit</a>

                    <form action="{{route('payment_packages.destroy',$paymentpackage->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger py-2">Delete</button>
                    </form>
                </td>
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
   