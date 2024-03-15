<select name="transaction_id" id="transaction_id" class="form-control" required>
    <option value="" disabled selected>Select Transaction</option>
    @foreach($transactions as $transaction)
        <option value="{{ $transaction->id }}" data-amount="{{ $transaction->amount ?? '' }}">{{ $transaction->name }}</option>
    @endforeach
</select>