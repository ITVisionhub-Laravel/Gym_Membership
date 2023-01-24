@extends('admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Add Member
                    <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/customers') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row pt-3">
                    <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Age</label>
                    <input type="number" name="age" class="form-control" placeholder="Enter Your Age">
                    @error('age')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Height</label>
                    <input type="text" name="height" class="form-control" placeholder="Enter Your Height">
                    @error('height')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Weight</label>
                    <input type="text" name="weight" class="form-control" placeholder="Enter Your Weight">
                    @error('weight')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                 <div class="row pt-3">
                <div class="form-group col-md-4">
                    <label for="">City</label>
                    <select  id="city" class="form-select" name="city" >
                            <option value="">Select City</option>
                            @foreach ($cities as $data)
                                <option  value="{{$data->id}}">
                                    {{$data->name}}
                                </option>
                            @endforeach
                    </select>
                    </div>
                    @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                    <div class="form-group col-md-4">
                        <label for="">Township</label>
                        <select id="township-dd" class="form-select" name="township" >
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Street</label>
                        <select id="street-dd" class="form-select" name="street" >
                        </select>
                    </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Mobile</label>
                    <input type="text" name="phone_number" class="form-control" placeholder="Enter Your Phone Number">
                    @error('phone_number')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Emergency Mobile</label>
                    <input type="text" name="emergency_phone" class="form-control" placeholder="Enter Your Emergency Phone Number">
                    @error('emergency_phone')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-3">
                    <label for="">Select Packages</label>
                    <select  id="package-dd" class="form-select" name="package" >
                            <option value="">Select Package</option>
                            @foreach ($packages as $data)
                            <option  value="{{ $data->id." ".$data->promotion." ".$data->original_price }}">
                                {{$data->package}}
                            </option>
                            @endforeach
                    </select>

                    @error('package')<small class="text-danger">{{ $message }}</small>@enderror 
                </div>
                <div class="form-group col-md-3">
                  <label for="promotion"> Promotion</label>
                  <input type="text" class="form-control" id="promotion" name="promotion"  placeholder="Promotion" required readonly/>
                </div>
                <div class="form-group col-md-3">
                  <label for="original_price">Original Price</label>
                  <input type="text" class="form-control" id="original_price" name="original_price"  placeholder="Original Price" required readonly/>
                </div>
                <div class="form-group col-md-3">
                  <label for="price"> Price</label>
                  <input type="text" class="form-control" id="price" name="price"  placeholder="Original Price" required readonly/>
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                <label for="provider" class="form-label">Payment Methods</label>
                <select name="provider" class="form-select @error('provider') is-invalid @enderror" aria-label=".form-select-lg example">
                    <option selected>Choose One Payment Method</option>
                    @foreach($providers as $provider)
                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                    @endforeach
                    
                </select>
                
                @error('provider')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
                <div class="form-group col-md-6">
                    <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror 
                </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script  type="text/javascript">
        $(document).ready(function () {
        
            $('#city').on('change', function () {
                var cityId = $(this).val();
                $("#township-dd").html('');
                $("#street-dd").html('');
                $.ajax({
                    url: "{{url('admin/customers/fetch_township')}}",
                    type: "POST",
                    data: {
                        city_id: cityId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#township-dd').html('<option value="">Select Township</option>');
                        $.each(result.townships, function (key, value) {
                            $("#township-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#township-dd').on('change', function () {
                var townshipId = $(this).val();
                $("#street-dd").html('');
                $.ajax({
                    url: "{{url('admin/customers/fetch_street')}}",
                    type: "POST",
                    data: {
                        township_id: townshipId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#street-dd').html('<option value="">Select Street</option>');
                        $.each(res.streets, function (key, value) {
                            $("#street-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
             $('#package-dd').on('change', function () {
                var packageData = $(this).val().split(" ");
                var original_price=packageData[2];
                var promotion=packageData[1];
                var price=original_price-(original_price*promotion/100);
                // alert(price);
                document.getElementById("promotion").value = promotion;
                document.getElementById("original_price").value = original_price;
                document.getElementById("price").value = price;
            });
        });
    </script>
    @endsection