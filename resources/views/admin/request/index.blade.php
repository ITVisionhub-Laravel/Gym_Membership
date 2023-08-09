<x-admin>
    <livewire:admin.request.index/>
     <x-slot name="scripts">
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();      
        });

    </script>
   
</x-slot> 
@push('scripts')
<script>
    // Initialize DataTable after Livewire updates the component
    Livewire.hook('afterDomUpdate', () => {
        $('#myTable').DataTable();
    });

    // Close modal event listener
    window.addEventListener('close-modal', event => {
        $('#addDeliveryRequest').modal('hide');
        $('#addWarehouseRequest').modal('hide');
        $('#addShopkeeperRequest').modal('hide');
    });
</script>

@endpush

</x-admin>
