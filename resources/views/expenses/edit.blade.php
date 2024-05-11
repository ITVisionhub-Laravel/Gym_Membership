<!-- resources/views/expenses/edit.blade.php -->
<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-body">
                <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{--  <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $expense->name }}" required>
                    </div>  --}}
                    <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $expense->name }}" width="col-md-12" />
                    <x-forms.forminput type="number" name="amount" placeholder="Enter Amount" value="{{ $expense->amount }}" width="col-md-12" />
                    <x-forms.forminput value="{{ $expense->invoice_slip }}" name="image" type="file" placeholder="Image" width="col-md-12" />
                    <x-forms.forminput name="invoice_id" placeholder="Invoice Id" value="{{ $expense->invoice_id }}" labelName="Invoice ID" width="col-md-12" />
                    {{--  <div class="mb-3">
                        <label for="invoice_id" class="form-label">invoice Id</label>
                        <input type="text" class="form-control" id="invoice_id" name="invoice_id" value="{{ $expense->invoice_id }}" required>
                    </div>  --}}
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>