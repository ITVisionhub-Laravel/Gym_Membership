<x-admin>
    <div class="container my-3">
                <x-successmessage/>
                        <h3>Slider List
                            <a href="{{url('admin/sliders/create')}}" class="btn btn-primary text-white btn-sm float-end">Add Slider</a>
                        </h3>
                        <hr>
                <table id="myTable" class="display">
                            <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                            <td>{{$slider->id}}</td>
                            <td>{{$slider->title}}</td>
                            <td>{{$slider->description}}</td>
                            <td>
                                <img src="{{asset("$slider->image")}}" style="width:70px;height:70px" alt="Slider">
                            </td>
                            <td>{{$slider->status =='0'? 'Visible':'Hidden'}}</td>
                            <td>
                                <a href="{{url('admin/sliders/'.$slider->id.'/edit')}}" class="btn btn-success">Edit</a>
                                <a href="{{url('admin/sliders/'.$slider->id.'/delete')}}" 
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
        $('#myTable').DataTable();
    } );
</script>
</x-slot>
</x-admin>