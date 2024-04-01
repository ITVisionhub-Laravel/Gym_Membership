<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <h3 class="my-2">Gym Class Lists
            <a href="{{ route('class.create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                Class</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Gym Class Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->id }}</td>
                        <td>{{ $class->name }}</td>
                        <td>
                            @if ($class->image)
                                <img src="{{ asset('uploads/class/' . $class->image) }}" style="width:70px;height:70px"
                                    alt="{{ $class->name }}">
                            @endif
                        </td>
                        <td>{{ $class->description }}</td>
                        <td>{{ $class->classCategory->name }}</td>
                        <td>
                            <a href="{{ route('class.edit', $class->id) }}" class="btn btn-info py-2">Edit</a>
                            <a href="{{ route('class.delete', $class->id) }}"
                                onclick="return confirm('Are you sure you want to delete this data?')"
                                class="btn btn-danger py-2">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>
            {{ $classes->links() }}
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
