<x-admin>
<div class="container my-3">
     <x-successmessage/>
    <h3 class="my-2">ShopTypes Lists</h3>
    <hr>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Hot-Line</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($shoptypes as $shoptype)
            <tr>
               <td>{{ $j++ }}</td>
                <td>{{$shoptype->name}}</td>
                <td>{{$shoptype->email}}</td>
                <td>{{$shoptype->address}}</td>
                <td>{{$shoptype->phone}}</td>
                <td>{{$shoptype->hot_line}}</td>
                <td>
                    <img src="{{asset($shoptype->image)}}" style="width:70px;height:70px" alt="">
                </td>
                <td>
                    <a href="{{url('admin/shoptypes/'.$shoptype->id.'/edit')}}" class="btn btn-info py-2">Edit</a>
                    <a href="{{ url('admin/shoptypes/'.$shoptype->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger py-2">Delete</a>
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
   