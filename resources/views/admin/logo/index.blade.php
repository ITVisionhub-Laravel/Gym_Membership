<x-admin>
     <div class="container my-3">
             <x-successmessage/>
                        <h3>Logo Image
                            <a href="{{url('admin/logo/create')}}" class="btn btn-primary text-white btn-sm float-end">Add Logo</a>
                        </h3>
                        <hr>
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Address</th>
                            <th>PhoneNumber</th>
                            <th>Email</th>
                            <th>OpenDay</th>
                            <th>OpenTime</th>
                            <th>CloseDay</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                               @foreach ($logos as $logo)
                                   <tr>
                                    <td>{{$logo->id}}</td>
                                    <td>{{$logo->name}}</td>
                                    <td>
                                        <img src="{{asset("$logo->image")}}" style="width:70px;height:70px" alt="logo">
                                    </td>
                                    <td>{{$logo->description}}</td>
                                    <td>{{$logo->location}}</td>
                                    <td>{{$logo->address}}</td>
                                    <td>{{$logo->ph_no}}</td>
                                    <td>{{$logo->email}}</td>
                                    <td>{{$logo->open_day}}</td>
                                    <td>{{$logo->open_time}}</td>
                                    <td>{{$logo->close_day}}</td>

                                    <td>
                                        <a href="{{url('admin/logo/'.$logo->id.'/edit')}}" class="btn btn-success">Edit</a>
                                        <a href="{{url('admin/logo/'.$logo->id.'/delete')}}" 
                                            onclick="return confirm('Are you sure you want to delete this data?');"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                   </tr>
                               @endforeach
                    </tbody>
                </table>
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