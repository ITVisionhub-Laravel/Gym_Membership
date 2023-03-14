<x-admin>
<div class="container my-3">
     <x-successmessage/>
    <h3 class="my-2">Brand Lists</h3>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $j=1;
            @endphp
            @foreach($brands as $brand)
            <tr>
                <td>{{$j++}}</td>
                <td>{{$brand->name}}</td> 
                <td>{{$brand->slug}}</td>
                <td>
                    <a href="{{url('admin/brands/'.$brand->id.'/edit')}}" class="btn btn-info py-2">Edit</a>
                    <a href="{{ url('admin/brands/'.$brand->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger py-2">Delete</a>
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
   