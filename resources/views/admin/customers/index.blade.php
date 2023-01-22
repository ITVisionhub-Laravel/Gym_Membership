@extends('admin')

@section('content')
<div class="container my-3">
     @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <h3 class="my-2">Members List
    <a href="{{ url('admin/customers/payment') }}"  class="btn btn-success btn-sm text-white float-end">Add Fees</a>
    <a href="{{ url('admin/customers/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Members</a>
    </h3>
    <hr>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Emergency Mobile</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->age }}</td>
                <td>{{ $customer->height}}</td>
                <td>{{ $customer->weight}}</td>
                <td>{{ $customer->address}}</td>
                <td>{{ $customer->phone_number}}</td>
                <td>{{ $customer->emergency_phone}}</td>
                <td>
                    <img src="{{asset('/uploads/customer/'.$customer->image)}}" style="width:50px;height:50px" alt="customer">
                </td>
                <td>
                    <a href="{{ url('admin/customers/invoice')}}" class="btn-success btn-sm"><i class="fa-regular fa-eye"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/edit') }}"  class="btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ url('admin/customers/'.$customer->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('script')
<script>
     $(document).ready( function () {
        $('#myTable').DataTable();
        // scrollX: true,
    } );
</script>
@endsection

<!--Payment Modal -->
<div class="modal fade" id="paymentModel" tabindex="-1" aria-labelledby="paymentModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="paymentModelLabel">Add Payment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form wire:submit.prevent="storeBrand">
      <div class="modal-body">
        <div class="mb-3">
          <label for="">Select Member</label>
          <select wire:model.defer="member_id" class="form-control" id="">
          </select>
        </div>
        <div class="mb-3">
            <label for="">Package</label>
            <input type="text" wire:model.defer="package" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Promotion</label>
            <input type="text" wire:model.defer="promotion" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Training Fees</label>
            <input type="text" wire:model.defer="training_fee" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Cash In</label>
            <input type="text" wire:model.defer="cash_in" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Remaining Fees</label>
            <input type="text" wire:model.defer="remaining_fee" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
    </div>
  </div>
