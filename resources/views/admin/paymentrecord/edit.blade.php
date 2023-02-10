@extends('admin')

@section('content')

<div class="container py-3 ">
   <div class="card p-5">
     <h3 class="text-center my-2">Payment Record Edit Form</h3>
     <form action="{{route('payment_records.update',$paymentrecord->id)}}" method="POST" >
        @csrf
        @method('PUT')
        <x-forms.dropdownfield :dropdownValues="$members" name="member_name" width="col-md-12" value="{{$member->name}}" labelName="Members Name"></x-forms.dropdownfield>

        {{-- <div class="mb-3">
            <label for="member_name" class="form-label">Members Name</label>
            <select name="member_name" class="form-select form-select-lg mb-3 @error('customer_name') is-invalid @enderror" aria-label=".form-select-lg example">
                <option selected>Choose One Member</option>
                @foreach($members as $member)
                    <option value="{{$member->id}}" @if ($member->id==$paymentrecord->customer_id) {{ 'selected' }} @endif>{{$member->name}}</option>
                @endforeach
               
            </select>
            
            @error('member_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label for="package" class="form-label">Packages</label>
            <select name="package" class="form-select form-select-lg mb-3 @error('package') is-invalid @enderror" aria-label=".form-select-lg example">
                <option selected>Choose One Package</option>
                @foreach($packages as $package)
                    <option value="{{$package->id}}"  @if ($package->id==$paymentrecord->package_id) {{ 'selected' }} @endif>{{$package->package}}</option>
                @endforeach
               
            </select>
            
            @error('package')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{$paymentrecord->price}}">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="record_date" class="form-label">Date</label>
            <input type="date" name="record_date"  class="form-control @error('record_date') is-invalid @enderror" value="{{$paymentrecord->record_date}}">
            
            @error('record_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="payment_record" class="form-label">Payment Methods</label>
            <select name="payment_record" class="form-select form-select-lg mb-3 @error('payment_record') is-invalid @enderror" aria-label=".form-select-lg example">
                <option selected>Choose One Payment Method</option>
                @foreach($payments as $payment)
                <option value="{{$payment->id}}"  @if ($payment->id==$paymentrecord->provider_id) {{ 'selected' }} @endif>{{$payment->name}}</option>
                @endforeach
                
            </select>
            
            @error('payment_record')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Update</button>
    </form>
   </div>
</div>

@endsection