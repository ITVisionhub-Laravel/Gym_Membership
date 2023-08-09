  <div>
     <div class="row mb-4" >
        <div class="col-md-8" style="color: red"> Shopkeeper Requesting Products</div>
        <div class="col-md-2">
            <a href="{{ url("admin/add-shopkeeper") }}"
                class="btn btn-primary text-white float-end">Request Products</a>
        </div>
        <div class="col-md-2">
            <a href="{{ url('admin/deliver_products') }}"
                class="btn btn-primary text-white float-end">Receive Products</a>
        </div>
    </div>
  <table id="myTable" class="display" wire:ignore>
        <thead>
            <tr>
                <th>Id</th>
                <th>Shop Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $j=1;
            @endphp
            @foreach($requests as $request)
                <tr>
                    <td>{{$j++}}</td>
                    @if ($request->shops)
                        <td>{{$request->shops->name}}</td>
                        @else
                        <td> Hello</td>
                    @endif

                    @if ($request->name)
                        <td>{{$request->name}}</td>
                        @else
                        <td>{{$request->products->name}}</td>
                    @endif
                            
                    <td>{{$request->quantity}}</td>
                    <td>
                        <a href="#" wire:click="approveDeliveryRequest({{ $request }})" data-bs-toggle="modal" data-bs-target="#addDeliveryRequest" class="btn btn-primary btn-sm float-end">Approve</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{--  <x-slot name="scripts">
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();      
        });

    </script>
   
</x-slot>   --}}
</div>
@push('scripts')
<script>
   $(document).ready(function () {
       Livewire.on('tableUpdated', function () {
        setTimeout(function () {
            $('#myTable').DataTable().destroy();
            $('#myTable').DataTable({
                paging: true,
                searching: true,
                // other DataTable options
            });
        }, 100);
    });

    });

    {{--  $(document).ready(function() {
    $('#myTable').DataTable({
        paging: true,
        searching: true
    });
});  --}}
    {{--  Livewire.on('component.rendered', function () {
        $('#myTable').DataTable();
    });  --}}
</script>
@endpush