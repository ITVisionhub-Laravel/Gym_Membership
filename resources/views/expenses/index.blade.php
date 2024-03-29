<x-admin>
<div class="container my-3">
    
    <x-successmessage/>

    <h3 class="my-4">Expenses</h3>

    <a href="{{ route('expenses.create') }}" class="btn btn-success mb-4">Create Expense</a>
    
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->name }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $transaction->id) }}" class="btn btn-info py-2">Edit</a>
                        <form action="{{ route('expenses.destroy', $transaction->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger py-2" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<x-slot name="scripts">
<script>
     $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
</x-slot>
</x-admin>
   