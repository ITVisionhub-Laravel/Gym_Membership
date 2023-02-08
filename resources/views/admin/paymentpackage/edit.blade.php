<x-admin>
<div class="container py-3 ">
   <div class="card p-5">
     <h3 class="text-center my-2">Package Edit Form</h3>
     <form action="{{route('payment_packages.update', $paymentpackage->id)}}" method="POST" >
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="package" class="form-label">Package</label>
            <input type="text" name="package" id="package" class="form-control @error('package') is-invalid @enderror" value="{{$paymentpackage->package}}">
            @error('package')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="promotion" class="form-label">Promotion (%)</label>
            <input type="text" name="promotion" id="promotion" class="form-control @error('promotion') is-invalid @enderror" value="{{$paymentpackage->promotion}}">
            @error('promotion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="original_price" class="form-label">Original Price</label>
            <input type="text" name="original_price" id="original_price" class="form-control @error('original_price') is-invalid @enderror" value="{{$paymentpackage->original_price}}">
            @error('original_price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Update</button>
    </form>
   </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>