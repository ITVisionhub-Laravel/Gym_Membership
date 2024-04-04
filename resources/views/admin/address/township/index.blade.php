<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <x-errormessage />
        <h3 class="my-2">Township Lists
            <a href="{{ route('township.create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                Township</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($townships as $township)
                    <tr>
                        <td>{{ $township->id }}</td>
                        <td>{{ $township->name }}</td>
                        <td>{{ $township->city->name }}</td>
                        <td>
                            <a href="{{ route('township.edit', $township->id) }}" class="btn btn-info py-2">Edit</a>
                            <a href="{{ route('township.delete', $township->id) }}"
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
