<x-admin>
<div class="row">
    <div class="col-md-12">
        <x-successmessage/>
        <div class="card">
            <div class="card-header">
                <h3>Trainer List
                    <a href="{{ url('admin/trainers/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Trainer</a>
                </h3>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>FbName</th>
                            <th>TwitterName</th>
                            <th>LinkIn</th>
                            <th>Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainers as $trainer)
                            <tr>
                            <td>{{ $trainer->id }}</td>
                            <td>{{ $trainer->name }}</td>
                            <td>{{ $trainer->description }}</td>
                            <td>{{ $trainer->fb_name }}</td>
                            <td>{{ $trainer->twitter_name }}</td>
                            <td>{{ $trainer->linkin_name }}</td>
                            <td>
                                <img src="{{ $trainer->image }}" style="width:70px;height:70px" alt="">
                             
                            </td>
                            
                            <td>
                                <a href="{{ url('admin/trainers/'.$trainer->id.'/edit') }}" class="btn btn-primary py-2">Edit</a>
                                <a href="{{ url('admin/trainers/'.$trainer->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger py-2">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-slot name="scripts">
    <script>
     $(document).ready( function () {
        $('#myTable').DataTable({
        scrollX: true,
        });
    } );
</script>

</x-slot>
</x-admin>