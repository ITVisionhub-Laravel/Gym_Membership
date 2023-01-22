@extends('admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Add Training Fees For Member
                    <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf
                <div class="row pt-3">
                <div class="form-group col-md-6">
                <label for="">Select Member</label>
                <select  id="member-dd" class="form-control" name="member">
                    <option value="">Select Member</option>
                        @foreach ($customers as $data)
                            <option value="{{$data->id}}">
                                {{$data->name}}
                            </option>
                        @endforeach
                </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Package</label>
                    <input type="text" name="package" class="form-control">
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Promotion</label>
                    <input type="text" name="promotion" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Training Fees</label>
                    <input type="text" name="training_fee" class="form-control">
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Cash In</label>
                    <input type="text" name="cash_in" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Remaining Fees</label>
                    <input type="text" name="remaining_fee" class="form-control">
                </div>
                </div>
                        <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection