  <div>
   
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
                        <td> - </td>
                    @endif

                    @if ($request->name)
                        <td>{{$request->name}}</td>
                        @else
                        <td>{{$request->products->name}}</td>
                    @endif
                            
                    <td>{{$request->quantity}}</td>
                    <td>
                        <a href="#" wire:click="approveWarehouseRequest({{ $request }})" data-bs-toggle="modal" data-bs-target="#addWarehouseRequest" class="btn btn-primary btn-sm float-end">Approve</a>
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

</script>
@endpush