<!-- resources/views/transactions/create.blade.php -->

<x-admin>
   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Transactions Create Form</h3>
     </div>
     <div class="card-body">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="0">Pending</option>
                    <option value="1">Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
     </div>
   </div>

    <x-slot name="scripts">
    </x-slot>
</x-admin>