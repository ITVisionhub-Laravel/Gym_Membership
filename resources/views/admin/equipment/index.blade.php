<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Equipment List
                    <a href="{{ url('admin/equipments/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Equipment</a>
                </h3>
            </div>
            <div class="card-body">
                <table id="myTable" class="display table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipments as $equipment)
                            <tr>
                            <td>{{ $equipment->id }}</td>
                            <td>{{ $equipment->name }}</td>
                            <td>
                                <img src="{{asset('/uploads/equipment/'.$equipment->image)}}" style="width:70px;height:70px" alt="">
                             
                            </td>
                            
                            <td>
                                <a href="{{ url('admin/equipments/'.$equipment->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('admin/equipments/'.$equipment->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a>
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
        $('#myTable').DataTable();
    } );
</script>
</x-slot>
</x-admin>