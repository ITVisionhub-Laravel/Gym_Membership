<x-admin>
    <div class="container my-3">
         <x-successmessage/>
                <h3>Gym Classes
                    <a href="{{ url('admin/class/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Class</a>
                </h3>
                <hr>
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Class Name</th>
                            <th>Description</th>
                            <th>Morning Time</th>
                            <th>Evening Time</th>
                            <th>Trainer Name</th>
                            <th>Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            <tr>
                            <td>{{ $class->id }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->description }}</td>
                            <td>{{ $class->morning_time }}</td>
                            <td>{{ $class->evening_time }}</td>
                            <td>{{ $class->trainer->name }}</td>
                            <td>
                                <img src="{{asset($class->image)}}" style="width:70px;height:70px" alt="">
                             
                            </td>
                            
                            <td>
                                <a href="{{ url('admin/class/'.$class->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('admin/class/'.$class->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a>
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