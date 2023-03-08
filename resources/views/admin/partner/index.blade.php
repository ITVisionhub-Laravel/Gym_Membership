<x-admin>
<div class="container my-3">
    <x-successmessage/>
    <h3 class="my-2">Partner List
    <a href="{{ url('admin/partner/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Partner</a>
    </h3>
    <hr>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($partners as $partner)
                <tr>
                <td>{{ $partner->id }}</td>
                <td>{{ $partner->name }}</td>
                <td>
                    <img src="{{asset($partner->image)}}" style="width:70px;height:70px" alt="">
                </td>
                
                <td>
                    <a href="{{ url('admin/partner/'.$partner->id.'/edit') }}" class="btn btn-primary py-2">Edit</a>
                    <a href="{{ url('admin/partner/'.$partner->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger py-2">Delete</a>
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

