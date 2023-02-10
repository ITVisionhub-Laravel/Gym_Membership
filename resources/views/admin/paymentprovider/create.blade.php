@extends('admin')

@section('content')

<div class="container py-3 ">
   <div class="card p-5">
     <h3 class="text-center my-2">Payment Create Form</h3>
     <form action="{{route('payment_providers.store')}}" method="POST" >
        @csrf
        <x-forms.forminput name="name" labelName="Payment Type Name" placeholder="Enter Type Name" width="col-md-12" />
        <button type="submit" class="btn btn-outline-success float-end mt-3"> Save</button>
    </form>
   </div>
</div>

@endsection