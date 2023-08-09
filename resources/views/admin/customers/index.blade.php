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
                    <a href="{{ url('admin/customers/'.$customer->id.'/history')}}" class="btn-history btn-sm"><i class="fa-solid fa-clock-rotate-left text-white"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/invoice')}}" class="btn-invoice btn-sm"><i class="fa-solid fa-file-invoice text-white"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/edit') }}"  class="btn-edit btn-sm"><i class="fa-solid fa-pen-to-square text-white"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn-danger btn-sm"><i class="fa-solid fa-trash text-white"></i></a>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- The popup container -->
    <div id="customPopup" class="popup-container">
        <!-- The popup content -->
        <div class="popup-content">
            <p>Sorry, there are no payment records for this customer.</p>
            <button id="closeButton">Close</button>
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

