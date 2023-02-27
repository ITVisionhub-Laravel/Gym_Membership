<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Gym Classes
                    <a href="{{ url('admin/class/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Class</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
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
        </div>
    </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>