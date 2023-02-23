<x-admin>
<div class="container my-3">
    <x-successmessage/>
    <h3 class="my-2">Members List
    <a href="{{ url('admin/customers/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Members</a>
    </h3>
    <hr>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Emergency Mobile</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->age }}</td>
                <td>{{ $customer->height}} cm</td>
                <td>{{ $customer->weight}}</td>
                <td>
                    {{ $customer->address->street->township->city->name}},<br>
                    {{ $customer->address->street->township->name}},<br>
                    {{ $customer->address->street->name}}
                </td>
                <td>{{ $customer->phone_number}}</td>
                <td>{{ $customer->emergency_phone}}</td>
                <td>
                    <img src="{{asset('/uploads/customer/'.$customer->image)}}" style="width:50px;height:50px" alt="customer">
                </td>
                <td>
                    <a href="{{ url('admin/customers/'.$customer->id.'/invoice')}}" class="btn-success btn-sm"><i class="fa-regular fa-eye"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/edit') }}"  class="btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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

