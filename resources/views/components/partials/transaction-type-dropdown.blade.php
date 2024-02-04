<select name="transaction_type_id" id="transaction_type_id" class="form-control" required>
    <option value="" disabled selected>Select Transaction Types</option>
    @foreach($transactionTypes as $transaction)
        <option value="{{ $transaction->id }}" data-amount="{{ $transaction->amount ?? '' }}">{{ $transaction->name }}</option>
    @endforeach
</select>