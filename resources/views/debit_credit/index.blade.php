<x-admin>
    <div class="container my-3">

        <x-successmessage />

        <h3 class="my-4">Debit And Credit</h3>

        {{-- <a href="{{ route('debit-credit.create') }}" class="btn btn-success mb-4">Create DebitAndCredit</a> --}}

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Transaction Name</th>
                    <th>Transaction Type Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($debitCredits as $debitCredit)
                    <tr>
                        <td>{{ $debitCredit->id }}</td>
                        <td>{{ $debitCredit->name }}</td>
                        <td>{{ $debitCredit->amount }}</td>
                        <td>{{ $debitCredit->date }}</td>
                        <td>{{ $debitCredit->transaction->name }}</td>
                        <td>{{ $debitCredit->transactionType->name }}</td>
                        <td>
                            {{-- <a href="{{ route('debit-credit.show', $debitCredit->id) }}" class="btn btn-info">View</a> --}}
                            <a href="{{ route('debit-credit.edit', $debitCredit->id) }}"
                                class="btn btn-info py-2">Edit</a>
                            <form action="{{ route('debit-credit.destroy', $debitCredit->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger py-2"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
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
