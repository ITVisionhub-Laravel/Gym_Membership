<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <x-errormessage />

        <h3>Country
            <a href="{{ route('country.create') }}" class="btn btn-primary btn-sm text-white float-end">
                Add Country</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td>{{ $country->id }}</td>
                        <td>{{ $country->name }}</td>
                        <td>
                            <a href="{{ route('country.edit', $country->id) }}" class="btn btn-success py-2">Edit</a>
                            <a href="{{ route('country.delete', $country->id) }}"
                                onclick="return confirm('Are you sure you want to delete this data?')"
                                class="btn btn-danger py-2">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    </x-slot>
</x-admin>
