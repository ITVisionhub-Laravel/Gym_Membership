@extends('admin')

@section('content')

<div class="container py-3 ">
   <div class="card p-5 bg-secondary">
     <h3 class="text-center my-2">Package Create Form</h3>
     <form action="{{route('payment_packages.store')}}" method="POST" >
        @csrf
        <div class="mb-3">
            <label for="package" class="form-label">Package</label>
            <input type="text" name="package" id="package" class="form-control @error('package') is-invalid @enderror">
            @error('package')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="promotion" class="form-label">Promotion (%)</label>
            <input type="text" name="promotion" id="promotion" class="form-control @error('promotion') is-invalid @enderror">
            @error('promotion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="original_price" class="form-label">Original Price</label>
            <input type="text" name="original_price" id="original_price" class="form-control @error('original_price') is-invalid @enderror">
            @error('original_price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success float-end mt-3"> Save</button>
    </form>
   </div>
</div>

@endsection