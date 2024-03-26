<!-- resources/views/transactions/edit.blade.php -->
<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-body">
                <form action="{{ route('debit-credit.update', $debitCredit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ $debitCredit->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" name="amount" class="form-control" value="{{ $debitCredit->amount }}" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" name="date" class="form-control" value="{{ $debitCredit->date }}" required>
                    </div>
                    <div class="form-group">
                        <label for="transaction_id">Transaction:</label>
                        <select name="transaction_id" class="form-control" required>
                            @foreach($transactions as $transaction)
                                <option value="{{ $transaction->id }}" {{ $transaction->id == $debitCredit->transaction_id ? 'selected' : '' }}>
                                    {{ $transaction->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transaction_type_id">Transaction Type:</label>
                        <select name="transaction_type_id" class="form-control" required>
                            @foreach($transactionTypes as $transactionType)
                                <option value="{{ $transactionType->id }}" {{ $transactionType->id == $debitCredit->transaction_type_id ? 'selected' : '' }}>
                                    {{ $transactionType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>