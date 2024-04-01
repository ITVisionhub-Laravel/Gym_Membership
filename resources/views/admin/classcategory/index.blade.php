<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <h3>Gym Class Category List
            <a href="{{ route('classCategory.create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                Class</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Class Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($classCategories as $classCategory)
                    <tr>
                        <td>{{ $classCategory->id }}</td>
                        <td>{{ $classCategory->name }}</td>
                        <td>{{ $classCategory->description }}</td>
                        <td>
                            @if ($classCategory->image)
                                <img src="{{ asset('uploads/classcategory/' . $classCategory->image) }}"
                                    style="width:70px;height:70px" alt="{{ $classCategory->name }}">
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('class-category.edit', $classCategory->id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('classCategory.delete', $classCategory->id) }}"
                                onclick="return confirm('Are you sure you want to delete this data?')"
                                class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>
            {{ $classCategories->links() }}
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