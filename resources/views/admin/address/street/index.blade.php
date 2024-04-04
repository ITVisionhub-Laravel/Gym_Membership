<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <x-errormessage />
        <h3 class="my-2">Street Lists
            <a href="{{ route('street.create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                Street</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Ward</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($streets as $street)
                    <tr>
                        <td>{{ $street->id }}</td>
                        <td>{{ $street->name }}</td>
                        <td>{{ $street->ward->name }}</td>
                        <td>
                            <a href="{{ route('street.edit', $street->id) }}" class="btn btn-info py-2">Edit</a>
                            <a href="{{ route('street.delete', $street->id) }}"
                                onclick="return confirm('Are you sure you want to delete this data?')"
                                class="btn btn-danger py-2">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>
            {{-- {{ $classes->links() }} --}}
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    </x-slot>
</x-admin>
