{{-- @dd(Request::get('date') ?? date('Y-m-d')); --}}
<x-admin>
<div class="container my-3">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    @php 
    $j=1;
    @endphp
    @foreach($attendents as $attendent)
    <h3 class="my-2">Attendence List</h3>
    <a href="{{ url('admin/attendent/'.$attendent->attendent_date.'/print') }}" class="btnprint btn btn-success my-2 btn-sm float-end mx-1"><i class="fa fa-print"></i></a>
 

    <div class="row my-3">
        <div class="col-4">
            <form action="{{route('attendents.store')}}" method="post" class="d-inline-block">
                @csrf
                <input type="text" name="member" class="form-control w-50" style="display: inline-block;" placeholder="Enter member ID">
                <button type="submit" class="btn btn-outline-success">Check-in</button>
            </form>
        </div>
        
        <div class="row col-5">
            <form action="" method="GET" class="d-inline-block">
                <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d') }}" class="form-control w-50" style="display: inline-block;">
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
        
        <div class="col-3">
            <form action="{{route('attendent_check.store')}}" method="post" class="float-end">
                @csrf
                <!-- barcode -->
                <input type="text" name="member_check" class="form-control  placeholder_text float-end" autocomplete="off" autofocus="" placeholder="33554489012" style="display: inline-block;">
                <!-- end_barcode -->
            </form>
        </div>
    </div>
    
    <table id="myTable" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Attendence Date</th>
                <th>Member Name</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>

                <td>{{$j++}}</td>
                <td>{{$attendent->attendent_date}}</td>
                <td>{{$attendent->member->name}}</td>
                <td>{{$attendent->member->phone_number}}</td>
                <td>
                    <form action="{{route('attendents.destroy',$attendent->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger py-2">Delete</button>
                    </form>
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
<script  type="text/javascript">
    $(document).ready(function () {
      $('.btnprint').printPage();
    });
</script>
</x-slot>
</x-admin>