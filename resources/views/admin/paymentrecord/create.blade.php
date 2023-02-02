@extends('admin')

@section('content')

<div class="container py-3 ">
   <div class="card p-5 bg-secondary">
     <h3 class="text-center my-2">Payment Record Create Form</h3>
     <form action="{{route('payment_records.store')}}" method="POST" >
        @csrf
        <div class="mb-3">
            <label for="member_name" class="form-label">Members Name</label>
            <select name="member_name" class="form-select form-select-lg mb-3 @error('customer_name') is-invalid @enderror" aria-label=".form-select-lg example">
                <option selected>Choose One Member</option>
                @foreach($members as $member)
                    <option value="{{$member->id}}">{{$member->name}}</option>
                @endforeach
               
            </select>
            
            @error('member_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="package" class="form-label">Packages</label>
            <select name="package" class="form-select form-select-lg mb-3 @error('package') is-invalid @enderror" aria-label=".form-select-lg example">
                <option selected>Choose One Package</option>
                @foreach($packages as $package)
                    <option value="{{$package->id}}">{{$package->package}}</option>
                @endforeach
               
            </select>
            
            @error('package')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="record_date" class="form-label">Date</label>
            <input type="date" name="record_date"  class="form-control @error('record_date') is-invalid @enderror"/>
            
            @error('record_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="payment_record" class="form-label">Payment Methods</label>
            <select name="payment_record" class="form-select form-select-lg mb-3 @error('payment_record') is-invalid @enderror" aria-label=".form-select-lg example">
                <option selected>Choose One Payment Method</option>
                @foreach($payments as $payment)
                <option value="{{$payment->id}}">{{$payment->name}}</option>
                @endforeach
                
            </select>
            
            @error('payment_record')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success float-end mt-3"> Save</button>
    </form>
   </div>
</div>

@endsection