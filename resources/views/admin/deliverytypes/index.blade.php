<x-admin>
<div class="container my-3">
     <x-successmessage/>
    <h3 class="my-2">DeliveryType Lists</h3>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Kg</th>
                <th>TownshipName</th>
                <th>Cost</th>
                <th>WaitingTime</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($delivertypes as $delivertype)
            <tr>
                <td>{{$j++}}</td>
                <td>{{$delivertype->name}}</td>
                <td>
                    <img src="{{asset($delivertype->image)}}" style="width:70px;height:70px" alt="">
                </td>
                <td>{{$delivertype->kg}}kg</td>
                <td>{{$delivertype->township->name}}</td>
                <td>${{$delivertype->cost}}</td>
                <td>{{$delivertype->waiting_time}}day</td>
                <td>
                    <a href="{{url('admin/deliverytypes/'.$delivertype->id.'/edit')}}" class="btn btn-info py-2">Edit</a>
                    <a href="{{ url('admin/deliverytypes/'.$delivertype->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger py-2">Delete</a>
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
   