{{--  @dd("hello")  --}}
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
                    <td>{{$request->shops->name}}</td>
                    <td>{{$request->products->name}}</td>        
                    <td>{{$request->quantity}}</td>
                    <td>
                        <a href="#" wire:click="approveShopKeeperRequest({{ $request }})" data-bs-toggle="modal" data-bs-target="#addShopkeeperRequest" class="btn btn-primary btn-sm float-end">Approve</a>
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