<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <x-errormessage />

        <h3 class="my-2">State Lists
            <a href="{{ route('state.create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                State</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($states as $state)
                    <tr>
                        <td>{{ $state->id }}</td>
                        <td>{{ $state->name }}</td>
                        <td>{{ $state->country->name }}</td>
                        <td>
                            <a href="{{ route('state.edit', $state->id) }}" class="btn btn-info py-2">Edit</a>
                            <a href="{{ route('state.delete', $state->id) }}"
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
