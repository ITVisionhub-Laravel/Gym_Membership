<x-admin>
<div class="container my-3">
     <x-successmessage/>
    <h3 class="my-2">Products Lists</h3>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($shops as $shop)
            <tr>
                <td>{{$j++}}</td>
                <td>{{$shop->products->name}}</td>
                <td>
                    <img src="{{asset($shop->products->image)}}" style="width:70px;height:70px" alt="">
                </td>
                <td>${{$shop->products->buying_price}}</td>
                <td>${{$shop->products->selling_price}}</td>
                <td>${{$shop->products->quantity}}</td>
                <td>
                    <a href="{{url('admin/shops/'.$shop->id.'/edit')}}" class="btn btn-info py-2">Edit</a>
                    <a href="{{ url('admin/shops/'.$shop->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger py-2">Delete</a>
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
   