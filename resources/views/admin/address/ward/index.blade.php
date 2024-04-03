<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <x-errormessage />
        <h3 class="my-2">Ward Lists
            <a href="{{ route('ward.create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                Ward</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Township</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wards as $ward)
                    <tr>
                        <td>{{ $ward->id }}</td>
                        <td>{{ $ward->name }}</td>
                        <td>{{ $ward->township->name }}</td>
                        <td>
                            <a href="{{ route('ward.edit', $ward->id) }}" class="btn btn-info py-2">Edit</a>
                            <a href="{{ route('ward.delete', $ward->id) }}"
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
