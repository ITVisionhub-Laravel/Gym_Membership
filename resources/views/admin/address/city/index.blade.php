<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <x-errormessage />
        <h3 class="my-2">City Lists
            <a href="{{ route('city.create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                City</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->state->name }}</td>
                        <td>
                            <a href="{{ route('city.edit', $city->id) }}" class="btn btn-info py-2">Edit</a>
                            <a href="{{ route('city.delete', $city->id) }}"
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
