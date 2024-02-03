<!-- resources/views/transactions/create.blade.php -->

<x-admin>
   <div class="card w-50 mx-auto ">
     <div class="card-header">
        <h3 class="text-center my-1">Category Create Form</h3>
     </div>
     <div class="card-body">
        {{-- @dd($debitCredit->transaction->name) --}}
        <form action="{{ route('debit-credit.store') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="name">Item Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            {{-- <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" class="form-control" required>
            </div> --}}
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="transaction_id">Transaction:</label>
                <select name="transaction_id" id="transaction_id" class="form-control" required>
                    <option value="" disabled selected>Select Transaction</option>
                    @foreach($transactions as $transaction)
                        <option value="{{ $transaction->id }}" data-amount="{{ $transaction->amount }}">{{ $transaction->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" class="form-control" required readonly>
            </div>
            <div class="form-group">
                <label for="transaction_type_id">Transaction Type:</label>
                <select name="transaction_type_id" class="form-control" required>
                    <option value="" disabled selected>Select Transaction Type</option>
                    @foreach($transactionTypes as $transactionType)
                        <option value="{{ $transactionType->id }}">{{ $transactionType->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
     </div>
   </div>

    <x-slot name="scripts">
        <script>
            $(document).ready(function () {
                // Add change event listener to the transaction select element
                $("#transaction_id").change(function () {
                    // Get the selected option
                    var selectedOption = $(this).find(":selected");
                    // Update the amount field with the data-amount attribute of the selected option
                    $("#amount").val(selectedOption.data("amount"));
                });
            });
        </script>
    </x-slot>
</x-admin>