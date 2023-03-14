<x-admin>
<div class="container my-3">
     <x-successmessage/>
    <h3 class="my-2">Category Lists</h3>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Image</th>
                <th>Small Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($categories as $category)
            <tr>
                <td>{{$j++}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <img src="{{asset($category->image)}}" style="width:70px;height:70px" alt="">
                </td>
                <td>{{$category->small_description}}</td>
                <td>
                    <a href="{{url('admin/categories/'.$category->id.'/edit')}}" class="btn btn-info py-2">Edit</a>
                    <a href="{{ url('admin/categories/'.$category->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger py-2">Delete</a>
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
   