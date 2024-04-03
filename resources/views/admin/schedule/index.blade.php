<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <x-errormessage />
        <h3 class="my-2">Schedule Lists
            <a href="{{ route('schedule.create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                Schedule</a>
        </h3>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hours From</th>
                    <th>Hours To</th>
                    <th>Days Of Week</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <@foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->hours_From }}</td>
                        <td>{{ $schedule->hours_To }}</td>
                        <td>{{ $schedule->daysOfWeek->name }}</td>
                        <td>
                            <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-info py-2">Edit</a>
                            <a href="{{ route('schedule.delete', $schedule->id) }}"
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
