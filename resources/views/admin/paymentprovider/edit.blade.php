@extends('admin')

@section('content')

<div class="container py-3 ">
   <div class="card p-5 bg-secondary">
     <h3 class="text-center my-2">Packyment Type Edit Form</h3>
     <form action="{{route('payment_providers.update', $paymentprovider->id)}}" method="POST" >
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Payment Type Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$paymentprovider->name}}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success float-end mt-3"> Update</button>
    </form>
   </div>
</div>

@endsection