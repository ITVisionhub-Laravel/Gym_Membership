@extends('admin')

@section('content')

<div class="container py-3 ">
   <div class="card p-5">
     <h3 class="text-center my-2">Payment Create Form</h3>
     <form action="{{route('payment_providers.store')}}" method="POST" >
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Payment Type Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>
    </form>
   </div>
</div>

@endsection